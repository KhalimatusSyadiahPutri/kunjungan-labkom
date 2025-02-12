<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Kunjungan Lab')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            border: 2px solid white;
            padding: 5px;
            background-color: white;
            border-radius: 50%;
            max-width: 90px;
        }

        .sidebar h5,
        .sidebar h6 {
            font-size: 14px;
            text-align: center;
            color: white;
            margin-bottom: 5px;
            padding: 0 10px;
        }

        .sidebar .menu {
            width: 100%;
            padding: 10px 0;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: background 0.3s ease;
            width: 100%;
            text-align: left;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #f8f9fa;
        }

        /* Content */
        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* Responsive Sidebar */
        @media (max-width: 992px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="text-center p-3">
            <img src="{{ asset('logo.png') }}" alt="Logo Instansi" class="img-fluid">
        </div>
        <h5>Laboratorium Komputer</h5>
        <h6>Universitas Islam Kalimantan Arsyad Al Banjari Banjarmasin</h6>
        <div class="menu mt-4">
            <a href="{{ url('/') }}"><i class="bi bi-house-door"></i> Dashboard</a>
            <a href="{{ route('kunjungan.create') }}"><i class="bi bi-plus-circle"></i> Tambah Kunjungan</a>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-3">
            <div class="container-fluid">
                <button class="btn btn-dark d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <a class="navbar-brand ms-3" href="#">LABORATORIUM KOMPUTER UNISKA</a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle Sidebar -->
    <script>
        function toggleSidebar() {
            let sidebar = document.getElementById('sidebar');
            let content = document.querySelector('.content');

            if (sidebar.style.width === '250px' || sidebar.style.width === '') {
                sidebar.style.width = '0';
                content.style.marginLeft = '0';
            } else {
                sidebar.style.width = '250px';
                content.style.marginLeft = '250px';
            }
        }
    </script>

</body>

</html>
