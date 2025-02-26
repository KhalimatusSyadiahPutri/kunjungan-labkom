@extends('layouts.app')

@section('title', 'Data Kunjungan')

@section('content')
    <div class="dashboard-container">
        <div class="form-card main-card">
            <!-- Header Section dengan Background Gradient -->
            <div class="card-header dashboard-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon">
                            <i class="bi bi-journal-text"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Data Kunjungan</h4>
                            <small class="text-light">Manajemen data pengunjung laboratorium</small>
                        </div>
                    </div>
                    <div class="quick-stats d-none d-md-flex gap-4">
                        <div class="stat-item">
                            <i class="bi bi-people-fill"></i>
                            <div class="stat-details">
                                <span class="stat-value">{{ $kunjungans->count() }}</span>
                                <span class="stat-label">Total Kunjungan</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <i class="bi bi-calendar-check-fill"></i>
                            <div class="stat-details">
                                <span
                                    class="stat-value">{{ $kunjungans->where('tanggal_kunjungan', date('Y-m-d'))->count() }}</span>
                                <span class="stat-label">Hari Ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body dashboard-body">
                <!-- Filter Section -->
                <form method="GET" action="{{ route('kunjungan.index') }}" class="mb-4">
                    <div class="filter-container">
                        <div class="row g-3">
                            <div class="col-12 mb-4">
                                <h5 class="text-center section-title">Pilih Jenis Pengunjung</h5>
                                <div class="visitor-type-container">
                                    <div class="visitor-button-group">
                                        <button type="button"
                                            class="visitor-btn {{ request('tipe') == 'Mahasiswa' ? 'active' : '' }}"
                                            onclick="setTipe('Mahasiswa')">
                                            <div class="visitor-btn-content">
                                                <div class="icon-wrapper">
                                                    <i class="bi bi-mortarboard-fill"></i>
                                                </div>
                                                <span class="btn-label">Mahasiswa</span>
                                            </div>
                                        </button>

                                        <button type="button"
                                            class="visitor-btn {{ request('tipe') == 'Umum' ? 'active' : '' }}"
                                            onclick="setTipe('Umum')">
                                            <div class="visitor-btn-content">
                                                <div class="icon-wrapper">
                                                    <i class="bi bi-people-fill"></i>
                                                </div>
                                                <span class="btn-label">Umum</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="tipe" id="tipeInput" value="{{ request('tipe') }}">
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-calendar3"></i>
                                        Tanggal
                                    </label>
                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ request('tanggal') }}">
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-calendar-month"></i>
                                        Bulan
                                    </label>
                                    <select name="bulan" class="form-select">
                                        <option value="">Semua Bulan</option>
                                        @foreach (range(1, 12) as $bulan)
                                            <option value="{{ $bulan }}"
                                                {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-calendar-check"></i>
                                        Tahun
                                    </label>
                                    <select name="tahun" class="form-select">
                                        <option value="">Semua Tahun</option>
                                        @foreach (range(date('Y') - 5, date('Y')) as $tahun)
                                            <option value="{{ $tahun }}"
                                                {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="bi bi-building"></i>
                                        Fakultas
                                    </label>
                                    <select name="fakultas" class="form-select">
                                        <option value="">Semua Fakultas</option>
                                        @foreach ($fakultas as $f)
                                            <option value="{{ $f }}"
                                                {{ request('fakultas') == $f ? 'selected' : '' }}>
                                                {{ $f }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="filter-actions mt-4">
                            <div class="d-flex justify-content-center">
                                <div class="action-buttons">
                                    <button type="submit" class="action-btn filter-btn">
                                        <div class="btn-content">
                                            <i class="bi bi-funnel-fill"></i>
                                            <span>Filter Data</span>
                                        </div>
                                    </button>

                                    <a href="{{ route('kunjungan.index') }}" class="action-btn reset-btn">
                                        <div class="btn-content">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            <span>Reset Filter</span>
                                        </div>
                                    </a>

                                    <a href="{{ route('kunjungan.cetak', request()->query()) }}" target="_blank"
                                        class="action-btn print-btn">
                                        <div class="btn-content">
                                            <i class="bi bi-file-pdf-fill"></i>
                                            <span>Cetak PDF</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Table Section -->
                <div class="table-container mt-4">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NPM</th>
                                    <th>NIK</th>
                                    <th>Fakultas / Umum</th>
                                    <th>Tanggal</th>
                                    <th>Keperluan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kunjungans as $kunjungan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kunjungan->nama }}</td>
                                        <td>{{ $kunjungan->npm }}</td>
                                        <td>{{ $kunjungan->nik }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $kunjungan->fakultas ? 'bg-primary' : 'bg-secondary' }}">
                                                {{ $kunjungan->fakultas ?? 'Umum' }}
                                            </span>
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($kunjungan->tanggal_kunjungan)) }}</td>
                                        <td>{{ $kunjungan->keperluan }}</td>
                                        <td class="action-column">
                                            <form action="{{ route('kunjungan.destroy', $kunjungan->id) }}"
                                                method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Hapus Data">
                                                    <div class="delete-btn-content">
                                                        <i class="bi bi-trash"></i>
                                                    </div>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="bi bi-inbox text-muted fs-1 d-block mb-2"></i>
                                            <p class="text-muted mb-0">Tidak ada data yang tersedia.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('kunjungan.partials.form-style')

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <style>
        .dashboard-container {
            padding: 1.5rem;
            background: #f8f9fa;
        }

        .main-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header {
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            padding: 2rem;
            color: white;
        }

        .header-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .quick-stats {
            display: flex;
            gap: 2rem;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-item i {
            font-size: 1.8rem;
        }

        .stat-details {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .stat-label {
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .dashboard-body {
            padding: 2rem;
            background: #fff;
        }

        /* Enhance table styling */
        .table-container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
        }

        .table thead th {
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1rem;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Enhanced badge styling */
        .badge {
            padding: 0.6rem 1rem;
            border-radius: 50px;
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }

            .dashboard-header {
                padding: 1.5rem;
            }

            .quick-stats {
                margin-top: 1rem;
                flex-wrap: wrap;
            }

            .stat-item {
                width: 100%;
            }
        }

        /* Animation for stats */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-item {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .stat-item:nth-child(2) {
            animation-delay: 0.2s;
        }

        .filter-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .filter-actions {
            border-top: 1px solid #e0e0e0;
            padding-top: 1.5rem;
        }

        .btn-submit {
            min-width: 150px;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 3px;
        }

        .visitor-type-container {
            padding: 1rem;
            display: flex;
            justify-content: center;
        }

        .visitor-button-group {
            display: flex;
            gap: 2rem;
            justify-content: center;
            max-width: 600px;
            width: 100%;
        }

        .visitor-btn {
            flex: 1;
            min-width: 200px;
            max-width: 280px;
            padding: 1.5rem;
            border: none;
            border-radius: 16px;
            background: linear-gradient(145deg, #ffffff, #f0f0f0);
            box-shadow: 5px 5px 15px #d1d1d1,
                -5px -5px 15px #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .visitor-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .visitor-btn-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .icon-wrapper {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .icon-wrapper i {
            font-size: 1.8rem;
            color: white;
        }

        .btn-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .visitor-btn:hover {
            transform: translateY(-5px);
            box-shadow: 8px 8px 20px #d1d1d1,
                -8px -8px 20px #ffffff;
        }

        .visitor-btn:hover .icon-wrapper {
            transform: scale(1.1);
        }

        .visitor-btn.active {
            background: linear-gradient(145deg, var(--primary-color), var(--secondary-color));
            box-shadow: inset 5px 5px 10px rgba(0, 0, 0, 0.2),
                inset -5px -5px 10px rgba(255, 255, 255, 0.1);
        }

        .visitor-btn.active .btn-label {
            color: white;
        }

        .visitor-btn.active .icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Animation */
        @keyframes buttonPop {
            0% {
                transform: scale(0.95);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .visitor-btn.active {
            animation: buttonPop 0.3s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .visitor-button-group {
                flex-direction: column;
                gap: 1rem;
            }

            .visitor-btn {
                width: 100%;
                max-width: 100%;
                padding: 1.2rem;
            }

            .icon-wrapper {
                width: 50px;
                height: 50px;
            }

            .icon-wrapper i {
                font-size: 1.5rem;
            }

            .btn-label {
                font-size: 1rem;
            }
        }

        .action-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-btn {
            min-width: 180px;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-content {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .action-btn i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .action-btn span {
            font-weight: 600;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Filter Button */
        .filter-btn {
            background: linear-gradient(145deg, #2196F3, #1976D2);
            color: white;
        }

        .filter-btn:hover {
            background: linear-gradient(145deg, #1976D2, #2196F3);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.3);
        }

        /* Reset Button */
        .reset-btn {
            background: linear-gradient(145deg, #78909C, #607D8B);
            color: white;
        }

        .reset-btn:hover {
            background: linear-gradient(145deg, #607D8B, #78909C);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(96, 125, 139, 0.3);
        }

        /* Print Button */
        .print-btn {
            background: linear-gradient(145deg, #FF5722, #F4511E);
            color: white;
        }

        .print-btn:hover {
            background: linear-gradient(145deg, #F4511E, #FF5722);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(244, 81, 30, 0.3);
        }

        /* Button Hover Effects */
        .action-btn:hover i {
            transform: scale(1.2) rotate(360deg);
        }

        .action-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 120%;
            height: 120%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%) scale(0);
            border-radius: 50%;
            transition: transform 0.5s ease;
        }

        .action-btn:hover::after {
            transform: translate(-50%, -50%) scale(1);
        }

        /* Active State */
        .action-btn:active {
            transform: translateY(-1px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Loading State */
        .action-btn.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .action-btn.loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                width: 100%;
                gap: 1rem;
            }

            .action-btn {
                width: 100%;
                min-width: unset;
            }

            .btn-content {
                justify-content: center;
            }
        }

        /* Additional Animation */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        .action-btn:focus {
            animation: pulse 1.5s infinite;
        }

        /* Delete Button Styling */
        .action-column {
            width: 80px;
            text-align: center;
        }

        .btn-delete {
            width: 38px;
            height: 38px;
            padding: 0;
            border: none;
            background: white;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 3px 12px rgba(220, 53, 69, 0.1);
        }

        .delete-btn-content {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #dc3545;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .btn-delete::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, #dc3545, #c82333);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .btn-delete i {
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        /* Hover Effects */
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
        }

        .btn-delete:hover::before {
            opacity: 1;
        }

        .btn-delete:hover .delete-btn-content {
            color: white;
        }

        .btn-delete:hover i {
            transform: scale(1.1);
        }

        /* Active State */
        .btn-delete:active {
            transform: translateY(0);
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.15);
        }

        /* Loading State */
        .btn-delete.loading {
            pointer-events: none;
        }

        .btn-delete.loading .delete-btn-content {
            animation: deleteButtonPulse 1.5s infinite;
        }

        @keyframes deleteButtonPulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(0.95);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Tooltip */
        .btn-delete::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px 10px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            font-size: 12px;
            border-radius: 5px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .btn-delete:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: calc(100% + 5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .action-column {
                width: 60px;
            }

            .btn-delete {
                width: 34px;
                height: 34px;
            }

            .btn-delete i {
                font-size: 1rem;
            }
        }
    </style>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                },
                columnDefs: [{
                        responsivePriority: 1,
                        targets: [0, 1, -1]
                    },
                    {
                        responsivePriority: 2,
                        targets: [2, 4]
                    },
                    {
                        responsivePriority: 3,
                        targets: '_all'
                    }
                ]
            });

            // Enhanced Delete Confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                const form = this;
                const button = form.querySelector('.btn-delete');

                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.classList.add('loading');
                        form.submit();
                    }
                });
            });
        });

        function setTipe(tipe) {
            document.getElementById('tipeInput').value = tipe;
            document.querySelectorAll('.visitor-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.closest('.visitor-btn').classList.add('active');
        }

        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.add('loading');
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 2000);
            });
        });
    </script>
@endsection
