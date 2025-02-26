<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Kunjungan Lab')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.4rem;
            transition: all 0.3s ease;
        }

        .navbar-brand i {
            margin-right: 8px;
            color: #ffd700;
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Container Styles */
        .container {
            margin-top: 30px;
            margin-bottom: 30px;
            flex: 1;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Table Styles */
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
        }

        /* Footer Styles */
        footer {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            margin-top: auto;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
            font-weight: 300;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar-nav {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                padding: 10px;
                margin-top: 10px;
            }

            .nav-link {
                text-align: center;
                margin: 5px 0;
            }
        }

        /* Animation */
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

        .content-wrapper {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #1e3c72;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2a5298;
        }
    </style>
    {{-- <style>
    body {
        background: url("{{ asset('images/background.png) }}") no-repeat center center fixed;
        background-size: cover;
    }
    .hero-overlay {
        background: rgba(0, 0, 0, 0.5); /* Efek overlay gelap */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style> --}}

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-laptop-code"></i> LABORATORIUM KOMPUTER UNISKA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Dashboard</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kunjungan.create') }}">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Kunjungan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kunjungan.index') }}">
                            <i class="fas fa-users me-1"></i> Data Pengunjung
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>
                <i class="fas fa-copyright me-1"></i> {{ date('Y') }} Universitas Islam Kalimantan Muhammad Arsyad Al Banjari Banjarmasin
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
