<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembukuan</title>
    <style>
        .tengah {
            text-align: center;
        }
    </style>
</head>

<body>
    <table style="position: relative; top: 50px;">
        <thead>
            <tr>
                <th style="background-color: #D8E4BC;">No</th>
                <th style="background-color: #D8E4BC;">Jumlah</th>
                <th style="background-color: #D8E4BC;">Nominal Masuk</th>
                <th style="background-color: #D8E4BC;">Nominal Keluar</th>
                <th style="background-color: #D8E4BC;">Keterangan</th>
                <th style="background-color: #D8E4BC;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalMasuk = 0;
                $totalKeluar = 0;
            @endphp
            @foreach ($pembukuan as $index => $data)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ $data->jumlah }}</td>
                    <td style="text-align: center;">{{ $data->nominal_masuk != 0 ? $data->nominal_masuk : '-' }}</td>
                    <td style="text-align: center;">{{ $data->nominal_keluar != 0 ? $data->nominal_keluar : '-' }}</td>
                    <td style="text-align: left;">{{ $data->keterangan }}</td>
                    <td style="text-align: center;">{{ $data->tanggal->format('d F Y') }}</td>
                    {{ $totalMasuk += $pembukuan[$index]->nominal_masuk }}
                    {{ $totalKeluar += $pembukuan[$index]->nominal_keluar }}
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: center;">Jumlah Nominal Masuk</td>
                <td>{{ $totalMasuk }}</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;">Jumlah Nominal Keluar</td>
                <td>{{ $totalKeluar }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
