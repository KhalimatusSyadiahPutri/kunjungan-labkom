<!-- resources/views/kunjungan/cetak.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kunjungan Lab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .header h2 {
            color: #1e3c72;
            font-size: 22px;
            text-transform: uppercase;
            margin: 0;
        }

        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            page-break-inside: auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #1e3c72;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                visibility: visible;
            }

            table {
                display: table;
                width: 100%;
                border: 1px solid black;
            }

            th,
            td {
                border: 1px solid black !important;
                padding: 8px;
            }

            .header,
            .footer {
                visibility: visible;
                text-align: center;
            }
        }

        @page {
            margin: 2cm;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo Instansi" onerror="this.style.display='none'">
        <h2>Laporan Kunjungan Laboratorium Komputer</h2>
        <p>Universitas Islam Kalimantan Muhammad Arsyad Al Banjari Banjarmasin</p>
        <p>Periode: {{ request('tanggal') ?? 'Semua Periode' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NPM/NIK</th>
                <th>Tanggal</th>
                <th>Keperluan</th>
                <th>Fakultas</th>
            </tr>
        </thead>
        <tbody>
            @if ($kunjungans->count() > 0)
                @foreach ($kunjungans as $index => $kunjungan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kunjungan->nama }}</td>
                        <td>{{ $kunjungan->npm_nik }}</td>
                        <td>{{ date('d/m/Y', strtotime($kunjungan->tanggal_kunjungan)) }}</td>
                        <td>{{ $kunjungan->keperluan }}</td>
                        <td>{{ $kunjungan->fakultas ?? '-' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data kunjungan</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>
