@extends('layouts.app')

@section('title', 'Form Mahasiswa')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session('error'))
                <div class="alert-modal" id="alertModal">
                    <div class="alert-content">
                        <div class="alert-header bg-danger">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            <h5>Peringatan</h5>
                        </div>
                        <div class="alert-body">
                            <p>{{ session('error') }}</p>
                            <p class="mb-0"><strong>NPM/NIK:</strong> {{ session('npm_nik') }}</p>
                            <div class="mt-3">
                                <a href="{{ route('kunjungan.anggota') }}" class="btn btn-primary w-100">
                                    Ke Form Anggota
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if(session('success'))
                <div class="alert-modal" id="alertModal">
                    <div class="alert-content">
                        <div class="alert-header bg-success">
                            <i class="bi bi-check-circle-fill"></i>
                            <h5>Berhasil</h5>
                        </div>
                        <div class="alert-body">
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card form-card">
                    <div class="card-header">
                        <h4 class="mb-0 text-center">
                            <i class="bi bi-mortarboard-fill me-2"></i>
                            Form Kunjungan Mahasiswa
                        </h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('kunjungan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis_pengunjung" value="mahasiswa">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-calendar-check me-2"></i>Tanggal
                                        Kunjungan</label>
                                    <input type="date" name="tanggal_kunjungan" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-person-fill me-2"></i>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control"
                                        placeholder="Masukkan nama lengkap" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-card-list me-2"></i>NPM</label>
                                    <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-building me-2"></i>Fakultas
                                    </label>
                                    <select id="fakultas" name="fakultas" class="form-select" required>
                                        <option value="" selected disabled>Pilih Fakultas</option>
                                        <option value="Fakultas Hukum">Fakultas Hukum</option>
                                        <option value="Fakultas Ilmu Sosial dan Ilmu Politik">Fakultas Ilmu Sosial dan Ilmu Politik</option>
                                        <option value="Fakultas Teknik">Fakultas Teknik</option>
                                        <option value="Pasca Sarjana">Pasca Sarjana</option>
                                        <option value="Fakultas Keguruan dan Ilmu Pendidikan">Fakultas Keguruan dan Ilmu Pendidikan</option>
                                        <option value="Fakultas Pertanian">Fakultas Pertanian</option>
                                        <option value="Fakultas Farmasi">Fakultas Farmasi</option>
                                        <option value="Fakultas Ekonomi">Fakultas Ekonomi</option>
                                        <option value="Fakultas Teknik Informasi">Fakultas Teknik Informasi</option>
                                        <option value="Fakultas Kesehatan Masyarakat">Fakultas Kesehatan Masyarakat</option>
                                        <option value="Fakultas Studi Islam">Fakultas Studi Islam</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">
                                        <i class="bi bi-journal-text me-2"></i>Program Studi
                                    </label>
                                    <select id="prodi" name="prodi" class="form-select" required disabled>
                                        <option value="" selected disabled>Pilih Program Studi</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-chat-dots me-2"></i>Keperluan</label>
                                    <input type="text" name="keperluan" class="form-control"
                                        placeholder="Contoh: Penelitian, Tugas Akhir, Praktikum" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold"><i class="bi bi-telephone me-2"></i>No Telepon</label>
                                    <input type="text" name="no_telp" class="form-control"
                                        placeholder="Masukkan nomor telepon aktif" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-submit mt-4">
                                <i class="bi bi-save me-2"></i>Simpan Data
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

.form-select {
    background-color: #fff;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 0.6rem 1rem;
    transition: all 0.3s ease;
}

.form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(var(--primary-rgb), 0.25);
}

.form-select:disabled {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.select-focused label {
    color: var(--primary-color);
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

<script>
const prodiByFakultas = {
    'Fakultas Hukum': ['Hukum'],
    'Fakultas Ilmu Sosial dan Ilmu Politik': ['Ilmu Komunikasi', 'Ilmu Administrasi Publik'],
    'Fakultas Teknik': ['Teknik Mesin', 'Teknik Sipil', 'Teknik Elektro', 'Teknik Industri'],
    'Pasca Sarjana': ['Ilmu Komunikasi', 'Manajemen', 'Administrasi Publik', 'Peternakan'],
    'Fakultas Keguruan dan Ilmu Pendidikan': ['Pendidikan Bahasa Inggris', 'Bimbingan dan Konseling', 'Pendidikan Kimia', 'Pendidikan Olahraga'],
    'Fakultas Pertanian': ['Peternakan', 'Agribisnis'],
    'Fakultas Farmasi': ['Farmasi'],
    'Fakultas Ekonomi': ['Manajemen'],
    'Fakultas Teknik Informasi': ['Teknik Informatika', 'Sistem Informasi'],
    'Fakultas Kesehatan Masyarakat': ['Kesehatan Masyarakat'],
    'Fakultas Studi Islam': ['Hukum Ekonomi Syariah', 'Ekonomi Syariah', 'Pendidikan Guru Madrasah Ibtidaiyah']
};

document.getElementById('fakultas').addEventListener('change', function() {
    const prodiSelect = document.getElementById('prodi');
    prodiSelect.innerHTML = '<option value="" selected disabled>Pilih Program Studi</option>';
    
    if (this.value) {
        prodiSelect.removeAttribute('disabled');
        const prodis = prodiByFakultas[this.value];
        
        prodis.forEach(prodi => {
            const option = document.createElement('option');
            option.value = prodi;
            option.textContent = prodi;
            prodiSelect.appendChild(option);
        });
    } else {
        prodiSelect.setAttribute('disabled', true);
    }
});

// Tambahkan style untuk select
document.querySelectorAll('.form-select').forEach(select => {
    select.addEventListener('focus', function() {
        this.parentElement.classList.add('select-focused');
    });
    
    select.addEventListener('blur', function() {
        this.parentElement.classList.remove('select-focused');
    });
});
</script>

@include('kunjungan.partials.form-style')

@endsection
