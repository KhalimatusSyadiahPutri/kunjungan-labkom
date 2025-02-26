<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Kunjungan;

class KunjunganController extends Controller
{
    public function index(Request $request)
    {
        $query = Kunjungan::query();

        if ($request->tanggal) {
            $query->whereDate('tanggal_kunjungan', $request->tanggal);
        }
        if ($request->bulan) {
            $query->whereMonth('tanggal_kunjungan', $request->bulan);
        }
        if ($request->tahun) {
            $query->whereYear('tanggal_kunjungan', $request->tahun);
        }
        if ($request->fakultas) {
            $query->where('fakultas', $request->fakultas);
        }
        if ($request->tipe) {
            if ($request->tipe == 'Mahasiswa') {
                $query->whereNotNull('npm');
            } else {
                $query->whereNull('npm');
            }
        }

        $fakultas = Kunjungan::whereNotNull('fakultas')->distinct()->pluck('fakultas');
        $kunjungans = $query->get();

        return view('kunjungan.index', compact('kunjungans', 'fakultas'));
    }

    public function create(Request $request)
    {
        // Jika tidak ada parameter jenis, tampilkan halaman create
        if (!$request->has('jenis')) {
            return view('kunjungan.create');
        }
        
        $jenis = $request->query('jenis');
        
        switch ($jenis) {
            case 'mahasiswa':
                return view('kunjungan.form_mahasiswa');
            case 'umum':
                return view('kunjungan.form_umum');
            case 'anggota':
                return view('kunjungan.form_anggota');
            default:
                return view('kunjungan.create');
        }
    }

    public function store(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'nama' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'jenis_pengunjung' => 'required|in:mahasiswa,umum',
        ]);

        try {
            // Untuk Mahasiswa
            if ($request->jenis_pengunjung === 'mahasiswa') {
                $request->validate([
                    'npm' => 'required|string|max:255',
                    'fakultas' => 'required|string|max:255',
                    'prodi' => 'required|string|max:255',
                ]);

                // Cek apakah NPM sudah pernah terdaftar
                $existingMahasiswa = Kunjungan::where('npm', $request->npm)->first();

                if ($existingMahasiswa) {
                    return redirect()->route('kunjungan.create', ['jenis' => 'anggota'])
                        ->with('error', 'Maaf anda sudah terdaftar sebagai anggota, silahkan isi form kunjungan pada menu anggota')
                        ->with('npm_nik', $request->npm);
                }

            // Untuk Umum
            } else {
                $request->validate([
                    'nik' => 'required|string|size:16',
                    'pekerjaan' => 'required|string|max:255',
                ]);

                // Cek apakah NIK sudah pernah terdaftar
                $existingUmum = Kunjungan::where('nik', $request->nik)->first();

                if ($existingUmum) {
                    return redirect()->route('kunjungan.create', ['jenis' => 'anggota'])
                        ->with('error', 'Maaf anda sudah terdaftar sebagai anggota, silahkan isi form kunjungan pada menu anggota')
                        ->with('npm_nik', $request->nik);
                }
            }

            // Jika belum terdaftar, simpan data baru
            Kunjungan::create([
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'nama' => $request->nama,
                'npm' => $request->jenis_pengunjung === 'mahasiswa' ? $request->npm : null,
                'nik' => $request->jenis_pengunjung === 'umum' ? $request->nik : null,
                'fakultas' => $request->fakultas,
                'prodi' => $request->prodi,
                'pekerjaan' => $request->pekerjaan,
                'keperluan' => $request->keperluan,
                'no_telp' => $request->no_telp,
                'jenis_pengunjung' => $request->jenis_pengunjung,
            ]);

            return redirect()->back()->with([
                'success' => 'Data kunjungan berhasil disimpan!',
                'npm_nik' => $request->jenis_pengunjung === 'mahasiswa' ? $request->npm : $request->nik
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan! Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        return view('kunjungan.e dit', compact('kunjungan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'nama' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
        ]);

        Kunjungan::findOrFail($id)->update($request->all());

        return redirect()->route('kunjungan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Kunjungan::findOrFail($id)->delete();
        return redirect()->route('kunjungan.index')->with('success', 'Data berhasil dihapus');
    }

    public function cetak(Request $request)
    {
        $query = Kunjungan::query();

        if ($request->tanggal) {
            $query->whereDate('tanggal_kunjungan', $request->tanggal);
        }
        if ($request->bulan) {
            $query->whereMonth('tanggal_kunjungan', $request->bulan);
        }
        if ($request->tahun) {
            $query->whereYear('tanggal_kunjungan', $request->tahun);
        }
        if ($request->fakultas) {
            $query->where('fakultas', $request->fakultas);
        }
        if ($request->tipe) {
            if ($request->tipe == 'Mahasiswa') {
                $query->whereNotNull('npm');
            } else {
                $query->whereNull('npm');
            }
        }

        $kunjungans = $query->get();
        $pdf = Pdf::loadView('kunjungan.cetak', compact('kunjungans'))->setPaper('A4', 'portrait');

        return $pdf->download('Laporan_Kunjungan_Lab.pdf');
    }

    public function formAnggota()
    {
        return view('kunjungan.form_anggota');
    }

    public function simpanAnggota(Request $request)
    {
        $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'identitas' => 'required|string',
            'keperluan' => 'required|string',
        ]);

        // Cek apakah identitas (NPM/NIK) sudah pernah berkunjung
        $pengunjung = Kunjungan::where('npm', $request->identitas)
                    ->orWhere('nik', $request->identitas)
                    ->first();

        if (!$pengunjung) {
            return redirect()->back()->with('error', 'Belum pernah berkunjung sebelumnya.');
        }

        // Simpan kunjungan baru berdasarkan identitas yang sudah ada
        Kunjungan::create([
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'nama' => $pengunjung->nama,
            'npm' => $pengunjung->npm,
            'nik' => $pengunjung->nik,
            'fakultas' => $pengunjung->fakultas,
            'prodi' => $pengunjung->prodi,
            'keperluan' => $request->keperluan,
            'no_telp' => $pengunjung->no_telp,
        ]);

        return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil disimpan.');
    }

    public function storeAnggota(Request $request)
    {
        $request->validate([
            'identitas' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
            'keperluan' => 'required|string|max:255',
        ]);

        // Cek pengunjung berdasarkan NPM atau NIK
        $existingMember = Kunjungan::where('npm', $request->identitas)
            ->orWhere('nik', $request->identitas)
            ->first();

        if (!$existingMember) {
            return redirect()->back()
                ->with('error', 'NPM/NIK tidak ditemukan! Silakan daftar sebagai pengunjung baru.')
                ->with('npm_nik', $request->identitas);
        }

        // Cek apakah sudah berkunjung hari ini
        $todayVisit = Kunjungan::where(function($query) use ($request) {
                $query->where('npm', $request->identitas)
                      ->orWhere('nik', $request->identitas);
            })
            ->whereDate('tanggal_kunjungan', $request->tanggal_kunjungan)
            ->first();

        if ($todayVisit) {
            return redirect()->back()
                ->with('error', 'Anda sudah mengisi form kunjungan untuk hari ini!')
                ->with('npm_nik', $request->identitas);
        }

        try {
            Kunjungan::create([
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'nama' => $existingMember->nama,
                'npm' => $existingMember->npm,
                'nik' => $existingMember->nik,
                'fakultas' => $existingMember->fakultas,
                'prodi' => $existingMember->prodi,
                'pekerjaan' => $existingMember->pekerjaan,
                'keperluan' => $request->keperluan,
                'no_telp' => $existingMember->no_telp,
                'jenis_pengunjung' => $existingMember->jenis_pengunjung
            ]);

            return redirect()->back()->with([
                'success' => 'Kunjungan anggota berhasil dicatat!',
                'npm_nik' => $request->identitas
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan! Silakan coba lagi.');
        }
    }
}