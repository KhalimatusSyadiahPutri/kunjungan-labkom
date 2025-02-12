<!-- resources/views/kunjungan/cetak.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kunjungan Lab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 align="center">Laporan Kunjungan Lab</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NPM/NIK</th>
                <th>Tanggal Kunjungan</th>
                <th>Keperluan</th>
                <th>Fakultas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungans as $index => $kunjungan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kunjungan->nama }}</td>
                    <td>{{ $kunjungan->npm ?? $kunjungan->nik }}</td>
                    <td>{{ $kunjungan->tanggal_kunjungan }}</td>
                    <td>{{ $kunjungan->keperluan }}</td>
                    <td>{{ $kunjungan->fakultas ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
