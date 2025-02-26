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
            filter: brightness(0.7);
            transition: transform 20s ease;
        }

        .hero:hover img {
            transform: scale(1.1);
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                rgba(0, 0, 0, 0.7),
                rgba(0, 0, 0, 0.4),
                rgba(0, 0, 0, 0.7)
            );
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 80%;
            padding: 40px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            backdrop-filter: blur(5px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-content p {
            font-size: 1.6rem;
            margin-bottom: 20px;
            color: #FFA500;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .hero h1 {
            font-size: 3.5rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            margin-bottom: 30px;
            line-height: 1.2;
            font-family: 'Arial', sans-serif;
        }

        .btn-masuk {
            background: linear-gradient(45deg, #FFA500, #FF8C00);
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 50px;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 165, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-masuk:hover {
            background: linear-gradient(45deg, #FF8C00, #FFA500);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 165, 0, 0.4);
            color: white;
        }

        .btn-masuk:active {
            transform: translateY(1px);
        }

        @media (max-width: 768px) {
            .hero-content {
                padding: 20px;
                max-width: 95%;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero-content p {
                font-size: 1.2rem;
            }

            .btn-masuk {
                font-size: 1rem;
                padding: 12px 30px;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .hero-content p {
                font-size: 1rem;
            }
        }
    </style>

    <div class="hero">
        <img src="{{ asset('Selamat datang di Labo.png') }}" alt="Selamat Datang di Laboratorium Komputer">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <p>Selamat Datang di Laboratorium Komputer</p>
            <h1>Universitas Islam Kalimantan<br> Muhammad Arsyad Al Banjari<br>Banjarmasin</h1>
            <a href="{{ route('kunjungan.create') }}" class="btn-masuk">Masuk Sekarang</a>
        </div>
    </div>
@endsection
