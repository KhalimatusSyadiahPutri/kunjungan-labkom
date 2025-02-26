<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Laboratorium Komputer UNISKA">
    <meta name="theme-color" content="#1e3c72">
    <title>@yield('title', 'Aplikasi Kunjungan Lab')</title>

    <!-- Fonts & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1e3c72;
            --secondary-color: #2a5298;
            --accent-color: #ffd700;
            --text-light: rgba(255, 255, 255, 0.8);
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            padding-top: 20px;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1000;
            box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
        }

        .sidebar-header {
            position: relative;
            width: 100%;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.2);
            padding: 4px;
            border-radius: 50%;
            margin-bottom: 15px;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar img:hover {
            transform: scale(1.05) rotate(5deg);
            border-color: var(--accent-color);
        }

        .sidebar h5 {
            color: #ffffff;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .sidebar h6 {
            color: var(--text-light);
            font-size: 0.9rem;
            line-height: 1.5;
            padding: 0 20px;
        }

        .sidebar .menu {
            width: 100%;
            padding: 25px 0;
            margin-top: 20px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--text-light);
            text-decoration: none;
            transition: all var(--transition-speed) ease;
            border-left: 4px solid transparent;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: rgba(255, 255, 255, 0.1);
            transition: width var(--transition-speed) ease;
        }

        .sidebar a:hover::before {
            width: 100%;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 1.3rem;
            width: 25px;
            text-align: center;
            transition: transform var(--transition-speed) ease;
        }

        .sidebar a:hover i {
            transform: translateX(5px);
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-left-color: var(--accent-color);
            font-weight: 600;
        }

        /* Content Styles */
        .content {
            margin-left: 280px;
            padding: 20px;
            min-height: 100vh;
            transition: all var(--transition-speed) ease;
            background-color: #f0f2f5;
        }

        /* Navbar Styles */
        .navbar {
            background: #ffffff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            border-radius: 15px;
            margin-bottom: 25px;
            padding: 15px 20px;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            font-size: 1.5rem;
            color: var(--secondary-color);
        }

        .toggle-sidebar-btn {
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 10px 18px;
            border-radius: 12px;
            color: white;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .toggle-sidebar-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 60, 114, 0.2);
        }

        .toggle-sidebar-btn:active {
            transform: translateY(1px);
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all var(--transition-speed) ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .sidebar {
                width: 250px;
            }
            .content {
                margin-left: 250px;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                box-shadow: none;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.15);
            }

            .content {
                margin-left: 0;
            }

            .content.pushed {
                transform: translateX(0);
                opacity: 0.7;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.1rem;
            }
            
            .sidebar img {
                width: 90px;
                height: 90px;
            }

            .sidebar h5 {
                font-size: 1.1rem;
            }

            .sidebar h6 {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
            
            .navbar {
                padding: 10px 15px;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            border-radius: 4px;
            transition: all var(--transition-speed) ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('logo.png') }}" alt="Logo Instansi" class="mb-3">
            <h5>Laboratorium Komputer</h5>
            <h6>Universitas Islam Kalimantan Arsyad Al Banjari Banjarmasin</h6>
        </div>
        <div class="menu">
            <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i> Dashboard
            </a>
            <a href="{{ route('kunjungan.create') }}" class="{{ Request::is('kunjungan/create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle-fill"></i> Tambah Kunjungan
            </a>
            <a href="{{ route('kunjungan.index') }}" class="{{ Request::is('kunjungan') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Data Pengunjung
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content" id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="toggle-sidebar-btn d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <a class="navbar-brand ms-3" href="#">
                    <i class="fas fa-laptop-code"></i>
                    <span>LABORATORIUM KOMPUTER UNISKA</span>
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Loading overlay
        const loadingOverlay = document.querySelector('.loading-overlay');
        
        window.addEventListener('load', () => {
            loadingOverlay.classList.remove('active');
        });

        document.addEventListener('DOMContentLoaded', () => {
            loadingOverlay.classList.add('active');
            setTimeout(() => {
                loadingOverlay.classList.remove('active');
            }, 500);
        });

        // Sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            
            sidebar.classList.toggle('active');
            content.classList.toggle('pushed');
        }

        // Responsive handling
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            
            if (window.innerWidth > 992) {
                sidebar.classList.remove('active');
                content.classList.remove('pushed');
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
