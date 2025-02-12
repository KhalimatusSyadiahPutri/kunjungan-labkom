@extends('layouts.data')

@section('title', 'Data Kunjungan')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4>📋 Data Kunjungan</h4>
            {{-- <a href="{{ route('kunjungan.create') }}" class="btn btn-success">➕ Tambah Kunjungan</a> --}}
        </div>

        <div class="card-body">
            <!-- Filter -->
            <form method="GET" action="{{ route('kunjungan.index') }}" class="mb-3">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="bulan" class="form-select">
                            <option value="">Pilih Bulan</option>
                            @foreach (range(1, 12) as $bulan)
                                <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="tahun" class="form-select">
                            <option value="">Pilih Tahun</option>
                            @foreach (range(date('Y') - 5, date('Y')) as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="fakultas" class="form-select">
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $f)
                                <option value="{{ $f }}" {{ request('fakultas') == $f ? 'selected' : '' }}>
                                    {{ $f }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="tipe" class="form-select">
                            <option value="">Pilih Pengunjung</option>
                            <option value="Mahasiswa" {{ request('tipe') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa
                            </option>
                            <option value="Umum" {{ request('tipe') == 'Umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">🔍 Filter</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary w-100">🔄 Reset</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('kunjungan.cetak', request()->query()) }}" target="_blank"
                            class="btn btn-danger w-100">🖨 Cetak PDF</a>
                    </div>
                </div>
            </form>

            <!-- Data Tabel -->
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM / NIK</th>
                        <th>Fakultas / Umum</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Keperluan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kunjungans as $kunjungan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kunjungan->nama }}</td>
                            <td>{{ $kunjungan->npm_nik }}</td>
                            <td>{{ $kunjungan->fakultas ?? 'Umum' }}</td>
                            <td>{{ date('d-m-Y', strtotime($kunjungan->tanggal_kunjungan)) }}</td>
                            <td>{{ $kunjungan->keperluan }}</td>
                            <td>
                                {{-- <a href="{{ route('kunjungan.edit', $kunjungan->id) }}" class="btn btn-warning btn-sm">✏️
                                    Edit</a> --}}
                                <form action="{{ route('kunjungan.destroy', $kunjungan->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">🗑
                                        Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
