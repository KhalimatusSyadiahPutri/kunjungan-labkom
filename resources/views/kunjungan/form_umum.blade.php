@extends('layouts.app')

@section('title', 'Form Kunjungan Umum')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Notifikasi Sukses --}}
                @if (session('success'))
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">✅ Pendaftaran Berhasil</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <p>{{ session('success') }}</p>
                                    <p><strong>NIK:</strong> {{ session('npm_nik') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('kunjungan.create') }}" class="btn btn-primary w-100">OK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Notifikasi Error --}}
                @if (session('error'))
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">❌ Pendaftaran Gagal</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <p>{{ session('error') }}</p>
                                    <p><strong>NIK:</strong> {{ session('npm_nik') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('kunjungan.anggota') }}" class="btn btn-danger w-100">OK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card shadow-lg">
                    <div class="card-header bg-warning text-white text-center">
                        <h4 class="mb-0"><i class="bi bi-person-badge-fill me-2"></i> Form Kunjungan Umum</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kunjungan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis_pengunjung" value="umum">

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-calendar-check me-2"></i>Tanggal
                                    Kunjungan</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-person-fill me-2"></i>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-card-list me-2"></i>NIK</label>
                                <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-briefcase me-2"></i>Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control"
                                    placeholder="Masukkan pekerjaan">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-chat-dots me-2"></i>Keperluan</label>
                                <input type="text" name="keperluan" class="form-control"
                                    placeholder="Contoh: Penelitian, Kunjungan" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>No Telepon</label>
                                <input type="text" name="no_telp" class="form-control"
                                    placeholder="Masukkan nomor telepon aktif" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100 fw-bold">
                                <i class="bi bi-save me-2"></i>Simpan Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
