@extends('layouts.app')

@section('title', 'Kunjungan Berhasil')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card shadow-lg text-center">
            <div class="card-header bg-success text-white">
                <h4>✅ Data Tersimpan</h4>
            </div>
            <div class="card-body">
                <h5 class="mb-3">Selamat Datang!</h5>
                <p>Terima kasih telah mengisi data kunjungan.</p>
                <a href="{{ route('kunjungan.create') }}" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
@endsection
