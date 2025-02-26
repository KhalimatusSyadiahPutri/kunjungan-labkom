@extends('layouts.app')

@section('title', 'Form Kunjungan Umum')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Notifikasi Modal --}}
                @if (session('success') || session('error'))
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white">
                                    <h5 class="modal-title">
                                        @if(session('success'))
                                            <i class="bi bi-check-circle me-2"></i>Pendaftaran Berhasil
                                        @else
                                            <i class="bi bi-x-circle me-2"></i>Pendaftaran Gagal
                                        @endif
                                    </h5>
                                </div>
                                <div class="modal-body text-center py-4">
                                    <p class="mb-2">{{ session('success') ?? session('error') }}</p>
                                    <p class="mb-0"><strong>NIK:</strong> {{ session('npm_nik') }}</p>
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

                <div class="card form-card">
                    <div class="card-header">
                        <h4 class="mb-0 text-center">
                            <i class="bi bi-people-fill me-2"></i>
                            Form Kunjungan Umum
                        </h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('kunjungan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis_pengunjung" value="umum">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-calendar-check"></i>
                                        Tanggal Kunjungan
                                    </label>
                                    <input type="date" name="tanggal_kunjungan" 
                                           class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-person"></i>
                                        Nama Lengkap
                                    </label>
                                    <input type="text" name="nama" class="form-control" 
                                           placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-card-text"></i>
                                        NIK
                                    </label>
                                    <input type="text" name="nik" class="form-control" 
                                           placeholder="Masukkan NIK" required
                                           pattern="[0-9]{16}" 
                                           title="NIK harus 16 digit angka">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-briefcase"></i>
                                        Pekerjaan
                                    </label>
                                    <input type="text" name="pekerjaan" class="form-control" 
                                           placeholder="Masukkan pekerjaan">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-chat-text"></i>
                                        Keperluan
                                    </label>
                                    <input type="text" name="keperluan" class="form-control" 
                                           placeholder="Contoh: Penelitian, Kunjungan" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="bi bi-telephone"></i>
                                        No Telepon
                                    </label>
                                    <input type="tel" name="no_telp" class="form-control" 
                                           placeholder="Masukkan nomor telepon aktif" required
                                           pattern="[0-9]{10,13}" 
                                           title="Nomor telepon harus 10-13 digit angka">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-submit mt-4">
                                <i class="bi bi-save me-2"></i>
                                Simpan Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
.alert-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1050;
    animation: fadeIn 0.3s ease;
}

.alert-content {
    background: white;
    border-radius: 15px;
    width: 90%;
    max-width: 400px;
    overflow: hidden;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    animation: slideIn 0.3s ease;
}

.alert-header {
    padding: 1.5rem;
    color: white;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-header i {
    font-size: 1.5rem;
}

.alert-header h5 {
    margin: 0;
    font-weight: 600;
}

.alert-body {
    padding: 1.5rem;
    text-align: center;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
</style>

<script>
// Auto close alert after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alertModal = document.getElementById('alertModal');
    if (alertModal && !alertModal.querySelector('.btn-primary')) {
        setTimeout(() => {
            alertModal.style.opacity = '0';
            setTimeout(() => {
                alertModal.remove();
            }, 300);
        }, 5000);
    }
});
</script>
    @include('kunjungan.partials.form-style')

    <script>
        // Validasi input NIK hanya angka
        document.querySelector('input[name="nik"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });

        // Validasi input nomor telepon hanya angka
        document.querySelector('input[name="no_telp"]').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 13) {
                this.value = this.value.slice(0, 13);
            }
        });
    </script>
@endsection
