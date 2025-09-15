<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Lomba</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 0; }
        .sub-title { text-align: center; font-size: 14px; margin-top: 0; }
        ul { padding-left: 20px; margin: 0; }
    </style>
</head>
<body>
    <h2>Laporan Hasil Perlombaan</h2>
    <p class="sub-title">Dicetak pada: {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Sekolah</th>
                <th>Total Nilai (Rata-rata)</th>
                <th>Ranking</th>
                <th>Anggota Tim</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_sekolah }}</td>
                <td>{{ number_format($data->total_nilai, 2) }}</td>
                <td>{{ $data->ranking }}</td>
                <td>
                    <ul>
                        @foreach($data->anggota as $anggota)
                            <li>{{ $anggota }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach

            @if($hasil->isEmpty())
            <tr>
                <td colspan="5" style="text-align: center;">Belum ada data hasil</td>
            </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
