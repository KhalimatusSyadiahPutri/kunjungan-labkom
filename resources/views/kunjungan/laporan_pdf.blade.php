<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kunjungan Lab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 align="center">Laporan Kunjungan Lab</h2>
    <h3>UNIVERSITAS ISLAM KALIMANTAN ARSYAD AL BANJARI BANJARMASIN</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NPM / NIK</th>
                <th>Fakultas / Umum</th>
                <th>Tanggal Kunjungan</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungans as $kunjungan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kunjungan->nama }}</td>
                    <td>{{ $kunjungan->npm_nik }}</td>
                    <td>{{ $kunjungan->fakultas ?? 'Umum' }}</td>
                    <td>{{ date('d-m-Y', strtotime($kunjungan->tanggal_kunjungan)) }}</td>
                    <td>{{ $kunjungan->keperluan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
