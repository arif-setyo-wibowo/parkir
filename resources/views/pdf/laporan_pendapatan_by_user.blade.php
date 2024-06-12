<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendapatan by User</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Laporan Pendapatan by User</h2>
<p> Tanggal : {{ $namaBulanDipilih }} {{ $tahun }}</p>

<table>
    <tr>
        <th>No</th>
        <th>Plat</th>
        <th>Nama Mobil</th>
        <th>Merk</th>
        <th>Warna</th>
        <th>Nama User</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Keluar</th>
        <th>Total Bayar</th>
    </tr>
    @foreach($dataKeluar as $key => $item)
        <tr>
            <td width="1%">{{ $key + 1 }}</td>
            <td>{{ $item->plat }}</td>
            <td>{{ $item->nama_mobil }}</td>
            <td>{{ $item->merk }}</td>
            <td>{{ $item->warna }}</td>
            <td>{{ $item->nama }}</td>
            <td width="15%">{{ $item->tgl_masuk }}</td>
            <td width="15%">{{ $item->tgl_keluar }}</td>
            <td width="13%">{{ 'Rp ' . number_format($item->total, 0, ',', '.') }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="8" style="text-align: right;">Total Pendapatan:</td>
        <td width="18%">{{ 'Rp ' . number_format($totalPendapatan, 0, ',', '.') }}</td>
    </tr>
</table>

</body>
</html>
