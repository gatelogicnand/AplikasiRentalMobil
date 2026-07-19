<!DOCTYPE html>
<html>
<head>
    <title>Laporan Inventaris Mobil</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Inventaris Kendaraan Rental</h2>
    <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    
    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Merek & Tipe</th>
                <th class="text-center">Nomor Polisi</th>
                <th>Harga Sewa / Hari</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mobils as $index => $mobil)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $mobil->merek }} {{ $mobil->tipe }}</td>
                <td class="text-center">{{ $mobil->nomor_polisi }}</td>
                <td>Rp {{ number_format($mobil->harga_sewa_per_hari, 0, ',', '.') }}</td>
                <td class="text-center">{{ ucfirst($mobil->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>