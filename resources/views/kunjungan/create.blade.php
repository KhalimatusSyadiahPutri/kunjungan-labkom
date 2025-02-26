@extends('layouts.app')

@section('title', 'Pilih Jenis Kunjungan')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-5">
                <h2 class="section-title">Pilih Jenis Kunjungan</h2>
                <p class="text-muted">Silakan pilih jenis kunjungan sesuai dengan kategori Anda</p>
            </div>

            <!-- Pilihan Jenis Kunjungan -->
            <div class="visitor-type-section mb-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <a href="{{ route('kunjungan.create', ['jenis' => 'mahasiswa']) }}" class="visitor-card">
                            <div class="card-content">
                                <div class="icon-wrapper">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <h4>Mahasiswa</h4>
                                <p>Form kunjungan untuk mahasiswa aktif</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('kunjungan.create', ['jenis' => 'umum']) }}" class="visitor-card">
                            <div class="card-content">
                                <div class="icon-wrapper">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <h4>Umum</h4>
                                <p>Form kunjungan untuk pengunjung umum</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider">
                <span>atau</span>
            </div>

            <!-- Anggota Terdaftar Section -->
            <div class="member-section mt-5">
                <div class="text-center mb-4">
                    <h3>Anggota Terdaftar</h3>
                    <p class="text-muted">Sudah pernah berkunjung sebelumnya? Silakan isi form anggota</p>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="{{ route('kunjungan.create', ['jenis' => 'anggota']) }}" class="member-card">
                        <div class="card-content">
                            <div class="icon-wrapper">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <h4>Form Anggota</h4>
                            <p>Untuk pengunjung yang sudah terdaftar sebelumnya</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.section-title {
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1rem;
}

.visitor-card, .member-card {
    display: block;
    text-decoration: none;
    background: white;
    border-radius: 15px;
    padding: 2rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    height: 100%;
}

.visitor-card {
    border: 2px solid var(--primary-color);
}

.member-card {
    background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
    color: white;
    max-width: 400px;
    width: 100%;
}

.card-content {
    text-align: center;
}

.icon-wrapper {
    width: 70px;
    height: 70px;
    margin: 0 auto 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 2rem;
}

.visitor-card .icon-wrapper {
    background: var(--primary-color);
    color: white;
}

.member-card .icon-wrapper {
    background: rgba(255,255,255,0.2);
    color: white;
}

.visitor-card h4 {
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.visitor-card p {
    color: #6c757d;
    margin-bottom: 0;
}

.member-card h4, .member-card p {
    color: white;
}

.visitor-card:hover, .member-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.divider {
    text-align: center;
    margin: 3rem 0;
    position: relative;
}

.divider::before, .divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 45%;
    height: 1px;
    background: #dee2e6;
}

.divider::before { left: 0; }
.divider::after { right: 0; }

.divider span {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    color: #6c757d;
    font-weight: 500;
}

@media (max-width: 768px) {
    .visitor-card, .member-card {
        padding: 1.5rem;
    }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
}
</style>
@endsection
