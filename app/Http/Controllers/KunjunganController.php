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

    public function create()
    {
        return view('kunjungan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'nama' => 'required|string|max:255',
            'npm' => 'nullable|string|max:50',
            'nik' => 'nullable|string|max:50',
            'fakultas' => 'nullable|string|max:100',
            'prodi' => 'nullable|string|max:100',
            'keperluan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'jenis_pengunjung' => 'required|string|in:mahasiswa,umum',
        ]);

        Kunjungan::create($validatedData);

        return view('kunjungan.success'); // Menampilkan halaman sukses
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'tanggal_kunjungan' => 'required|date',
    //         'nama' => 'required|string|max:255',
    //         'npm' => 'nullable|string|max:20',
    //         'fakultas' => 'nullable|string',
    //         'program_studi' => 'nullable|string',
    //         'nik' => 'nullable|string|max:16',
    //         'keperluan' => 'required|string',
    //         'no_telp' => 'required|string|max:15',
    //     ]);

    //     // try {
    //     //         Kunjungan::create($request->all());

    //     //             return redirect()->route('kunjungan.create')->with([
    //     //                 'success' => 'Data kunjungan berhasil disimpan!',
    //     //                 'npm_nik' => $request->npm
    //     //             ]);
    //     //         } catch (\Exception $e) {
    //     //             return redirect()->route('kunjungan.create')->with([
    //     //                 'error' => 'NPM sudah terdaftar dalam database!',
    //     //                 'npm_nik' => $request->npm
    //     //             ]);
    //     //         }
    //     Kunjungan::create($request->all());
    //     return redirect()->route('kunjungan.create')->with('success', 'Data berhasil ditambahkan');
    // }



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
    // Validasi input
    $request->validate([
        'tanggal_kunjungan' => 'required|date',
        'npm_nik' => 'required|string',
        'keperluan' => 'required|string',
    ]);

    // Cek apakah pengunjung sudah pernah berkunjung sebelumnya
    $pengunjung = Kunjungan::where('npm', $request->npm_nik)
        ->orWhere('nik', $request->npm_nik)
        ->first();

    if (!$pengunjung) {
        return redirect()->back()->with('error', 'Belum pernah berkunjung sebelumnya.');
    }

    // Simpan data kunjungan baru
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

    return redirect()->route('kunjungan.anggota')->with('success', 'Selamat datang di Lab Komputer!');
}


}