@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Notifikasi jika NPM sudah terdaftar -->
        @if (session('npm_exists'))
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong>{{ session('npm_exists') }}</strong>
                <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-sm">OK</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h3 class="mb-0">Pilih Jenis Pengunjung</h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="row row-cols-1 row-cols-md-3 g-3 justify-content-center">
                            <div class="col">
                                <a href="?jenis=mahasiswa" class="btn btn-info btn-lg w-100 shadow fw-bold">
                                    <i class="bi bi-mortarboard-fill me-2"></i> Mahasiswa
                                </a>
                            </div>
                            <div class="col">
                                <a href="?jenis=umum" class="btn btn-warning btn-lg w-100 shadow fw-bold">
                                    <i class="bi bi-person-lines-fill me-2"></i> Umum
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-success text-white">
                        <h4 class="mb-0">Anggota Terdaftar</h4>
                    </div>
                    <div class="card-body text-center">
                        <a href="?jenis=anggota" class="btn btn-success btn-lg w-100 shadow fw-bold">
                            <i class="bi bi-people-fill me-2"></i> Anggota
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Menampilkan Form Sesuai Pilihan --}}
        @if (request()->get('jenis'))
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            @if (request()->get('jenis') == 'mahasiswa')
                                @include('kunjungan.form_mahasiswa')
                            @elseif(request()->get('jenis') == 'umum')
                                @include('kunjungan.form_umum')
                            @elseif(request()->get('jenis') == 'anggota')
                                @include('kunjungan.form_anggota')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
