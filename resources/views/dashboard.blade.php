@extends('layouts.halaman')

@section('title', 'Dashboard')

@section('content')
    <style>
        .hero {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            font-weight: bold;
            overflow: hidden;
        }

        .hero img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 80%;
            padding: 20px;
        }

        .hero h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 1.4rem;
            margin-bottom: 20px;
        }

        .btn-masuk {
            background-color: orange;
            border: none;
            padding: 12px 24px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }

        .btn-masuk:hover {
            background-color: darkorange;
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .btn-masuk {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>

    <div class="hero">
        <img src="{{ asset('Selamat datang di Labo.png') }}" alt="Selamat Datang di Laboratorium Komputer">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <p>SELAMAT DATANG DI LABORATORIUM KOMPUTER</p>
            <h1>Universitas Islam Kalimantan<br> Muhammad Arsyad Al Banjari<br>Banjarmasin</h1>
            {{-- <a href="{{ route('kunjungan.create') }}" class="btn btn-masuk">MASUK</a> --}}
        </div>
    </div>
@endsection
