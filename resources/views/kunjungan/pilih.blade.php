@extends('layouts.data')

@section('title', 'Pilih Jenis Pengunjung')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card shadow-lg text-center">
            <div class="card-header bg-info text-white">
                <h4>👤 Pilih Jenis Pengunjung</h4>
            </div>
            <div class="card-body">
                <a href="{{ route('kunjungan.create', ['type' => 'mahasiswa']) }}" class="btn btn-success mb-2">Mahasiswa</a>
                <a href="{{ route('kunjungan.create', ['type' => 'umum']) }}" class="btn btn-primary">Umum</a>
                <a href="{{ route('kunjungan.create', ['type' => 'anggota']) }}" class="btn btn-primary">Anggota</a>
            </div>
        </div>
    </div>
@endsection
