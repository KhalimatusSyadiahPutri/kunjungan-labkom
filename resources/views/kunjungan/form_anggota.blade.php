@extends('layouts.app')

@section('title', 'Form Anggota')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Modal Notifikasi --}}
                @if (session('success') || session('error'))
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white">
                                    <h5 class="modal-title">
                                        @if(session('success'))
                                            <i class="bi bi-check-circle me-2"></i>Selamat Datang di Lab Komputer
                                        @else
                                            <i class="bi bi-x-circle me-2"></i>Peringatan
                                        @endif
                                    </h5>
                                </div>
                                <div class="modal-body text-center py-4">
                                    <p class="mb-2">{{ session('success') ?? session('error') }}</p>
                                    <p class="mb-0"><strong>NPM/NIK:</strong> {{ session('npm_nik') }}</p>
                                </div>
                                <div class="modal-footer border-0">
                                    <a href="{{ route('kunjungan.create') }}" 
                                       class="btn {{ session('success') ? 'btn-success' : 'btn-danger' }} w-100">
                                        OK
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-card">
                    <div class="card-header">
                        <h4 class="mb-0 text-center">
                            <i class="bi bi-person-vcard-fill me-2"></i>
                            Form Kunjungan Anggota
                        </h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('kunjungan.anggota.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-calendar-check"></i>
                                        Tanggal Kunjungan
                                    </label>
                                    <input type="date" name="tanggal_kunjungan" 
                                           class="form-control" required
                                           value="{{ date('Y-m-d') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-person-badge"></i>
                                        NPM / NIK
                                    </label>
                                    <input type="text" name="identitas" 
                                           class="form-control" required
                                           placeholder="Masukkan NPM atau NIK"
                                           pattern="[0-9]{1,16}"
                                           title="Masukkan NPM atau NIK (maksimal 16 digit)">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">
                                        <i class="bi bi-chat-text"></i>
                                        Keperluan
                                    </label>
                                    <input type="text" name="keperluan" 
                                           class="form-control" required
                                           placeholder="Contoh: Penelitian, Praktikum, dll">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-submit mt-4">
                                <i class="bi bi-save me-2"></i>
                                Simpan Kunjungan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('kunjungan.partials.form-style')

    <script>
        // Validasi input identitas hanya angka
        document.querySelector('input[name="identitas"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });

        // Set tanggal default ke hari ini
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[name="tanggal_kunjungan"]').value = today;
        });
    </script>
@endsection
