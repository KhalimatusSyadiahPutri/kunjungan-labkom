@extends('layouts.app')

@section('title', 'Form Mahasiswa')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Notifikasi Sukses --}}
                @if (session('error'))
                    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0,0,0,0.5);">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">❌ Pendaftaran Gagal</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <p>{{ session('error') }}</p>
                                    <p><strong>NPM/NIK:</strong> {{ session('npm_nik') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('kunjungan.create') }}" class="btn btn-danger w-100">OK</a>
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
                                    <p><strong>NPM/NIK:</strong> {{ session('npm_nik') }}</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('kunjungan.anggota') }}" class="btn btn-danger w-100">OK</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0"><i class="bi bi-person-badge-fill me-2"></i> Form Kunjungan Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kunjungan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jenis_pengunjung" value="mahasiswa">

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
                                <label class="form-label fw-bold"><i class="bi bi-card-list me-2"></i>NPM</label>
                                <input type="text" name="npm" class="form-control" placeholder="Masukkan NPM"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-building me-2"></i>Fakultas</label>
                                <select id="fakultas" name="fakultas" class="form-select" required>
                                    <option value="" disabled selected>Pilih Fakultas</option>
                                    <option value="Hukum">Fakultas Hukum</option>
                                    <option value="Ilmu Sosial dan Politik">Fakultas Ilmu Sosial dan Ilmu Politik</option>
                                    <option value="Teknik">Fakultas Teknik</option>
                                    <option value="Sarjana">Pasca Sarjana</option>
                                    <option value="KIP">Fakultas Keguruan dan Ilmu Pendidikan</option>
                                    <option value="Pertanian">Fakultas Pertanian</option>
                                    <option value="Farmasi">Fakultas Farmasi</option>
                                    <option value="Ekonomi">Fakultas Ekonomi</option>
                                    <option value="Teknik Informatika">Fakultas Teknik Informasi</option>
                                    <option value="Kesmas">Fakultas Kesehatan Masyarakat</option>
                                    <option value="Studi Islam">Fakultas Studi Islam</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-journal-text me-2"></i>Program
                                    Studi</label>
                                <select id="prodi" name="prodi" class="form-select" required>
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-chat-dots me-2"></i>Keperluan</label>
                                <input type="text" name="keperluan" class="form-control"
                                    placeholder="Contoh: Penelitian, Tugas Akhir, Praktikum" required>
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

    <script>
        const prodiOptions = {
            "Hukum": ["Hukum"],
            "Ilmu Sosial dan Politik": ["Ilmu Komunikasi", "Ilmu Administrasi Publik"],
            "Teknik": ["Teknik Mesin", "Teknik Sipil", "Teknik Elektro", "Teknik Industri"],
            "Sarjana": ["Ilmu Komunikasi", "Manajemen", "Administrasi Publik", "Peternakan"],
            "KIP": ["Pendidikan Bahasa Inggris", "Bimbingan dan Konseling", "Pendidikan Kimia", "Pendidikan Olahraga"],
            "Pertanian": ["Peternakan", "Agribisnis"],
            "Farmasi": ["Farmasi"],
            "Ekonomi": ["Manajemen"],
            "Teknik Informatika": ["Teknik Informatika", "Sistem Informasi"],
            "Kesmas": ["Kesehatan Masyarakat"],
            "Studi Islam": ["Hukum Ekonomi Syariah", "Ekonomi Syariah", "Pendidikan Guru Madrasah Ibtidaiyah"]
        };

        document.getElementById('fakultas').addEventListener('change', function() {
            let fakultas = this.value;
            let prodiSelect = document.getElementById('prodi');
            prodiSelect.innerHTML = '<option value="" disabled selected>Pilih Program Studi</option>';

            if (prodiOptions[fakultas]) {
                prodiOptions[fakultas].forEach(function(prodi) {
                    let option = document.createElement('option');
                    option.value = prodi;
                    option.textContent = prodi;
                    prodiSelect.appendChild(option);
                });
            }
        });
    </script>

@endsection
