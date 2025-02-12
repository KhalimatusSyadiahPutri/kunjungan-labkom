@extends('layouts.app') <!-- Menggunakan layout utama -->

@section('content')
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="list-group-item active">Mahasiswa</a>
                    <a href="#" class="list-group-item">Umum</a>
                </div>
            </div>

            <!-- Form Kunjungan -->
            <div class="col-md-9">
                <h2>Form Tambah Kunjungan</h2>

                <!-- Pilihan Jenis Pengunjung -->
                <div class="form-group">
                    <label><strong>PREGISTER</strong></label>
                    <div>
                        <input type="radio" name="jenis_pengunjung" value="mahasiswa" checked onclick="toggleForm()">
                        Mahasiswa
                        <input type="radio" name="jenis_pengunjung" value="umum" onclick="toggleForm()"> Umum
                    </div>
                </div>

                <div class="form-group">
                    <label><strong>TERDAFTAR:</strong></label>
                    <div>
                        <input type="radio" name="jenis_pengunjung" value="umum" onclick="toggleForm()"> Anggota
                    </div>
                </div>

                <!-- Form Mahasiswa -->
                <div id="form-mahasiswa">
                    <h4>Form Mahasiswa</h4>
                    <form action="{{ route('kunjungan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>NPM</label>
                            <input type="text" name="npm" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Fakultas</label>
                            <input type="text" name="fakultas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Program Studi</label>
                            <input type="text" name="prodi" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Keperluan</label>
                            <textarea name="keperluan" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <!-- Form Umum -->
                <div id="form-umum" style="display:none;">
                    <h4>Form Pengunjung Umum</h4>
                    <form action="{{ route('kunjungan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Keperluan</label>
                            <textarea name="keperluan" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <!--Form Anggota-->
                <div id="form-mahasiswa">
                    <h4>Form Mahasiswa</h4>
                    <form action="{{ route('kunjungan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>NPM/NIK</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Keperluan</label>
                            <textarea name="keperluan" class="form-control"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Script untuk menampilkan/menghilangkan form -->
            <script>
                function toggleForm() {
                    var jenis = document.querySelector('input[name="jenis_pengunjung"]:checked').value;
                    document.getElementById('form-mahasiswa').style.display = (jenis === 'mahasiswa') ? 'block' : 'none';
                    document.getElementById('form-umum').style.display = (jenis === 'umum') ? 'block' : 'none';
                    document.getElementById('form-anggota').style.display = (jenis === 'anggota') ? 'block' : 'none';
                }
            </script>
        @endsection
