@extends('layouts.data')

@section('title', 'Form Anggota')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Form Kunjungan Anggota</h4>
            </div>
            <div class="card-body">

                {{-- Modal Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">✅ Selamat Datang di Lab Komputer</h5>
                                </div>
                                <div class="modal-body">
                                    <p>{{ session('success') }}</p>
                                    <p><strong>NPM/NIK:</strong> {{ session('npm_nik') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('kunjungan.create') }}" class="btn btn-primary">OK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Menampilkan Notifikasi Jika Data Tidak Ditemukan -->
                {{-- @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif --}}

                {{-- Modal Notifikasi Error --}}
                @if (session('error'))
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">⚠️ Peringatan</h5>
                                </div>
                                <div class="modal-body">
                                    <p>{{ session('error') }}</p>
                                    <p><strong>NPM/NIK:</strong> {{ session('npm_nik') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        onclick="window.location.reload()">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('kunjungan.anggota.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NPM / NIK</label>
                            <input type="text" name="identitas" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keperluan</label>
                            <input type="text" name="keperluan" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Simpan Kunjungan</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
