<!DOCTYPE html>
<html>
<head>
    <title>Laporan Parkir</title>
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

<h2>Laporan Parkir</h2>

<p>Mulai Tanggal: {{ $masuk }}</p>
<p>Sampai Tanggal: {{ $keluar }}</p>

<table>
    <tr>
        <th>No</th>
        <th>Nama Mobil</th>
        <th>Merk Mobil</th>
        <th>Warna Mobil</th>
        <th>Nama Pemilik</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Keluar</th>
        <th>Total Bayar</th>
    </tr>
    @php
        $total_pendapatan = 0; // Inisialisasi total pendapatan
    @endphp
    @foreach($data as $key => $item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->nama_mobil }}</td>
            <td>{{ $item->merk }}</td>
            <td>{{ $item->warna }}</td>
            <td>{{ $item->nama_pemilik }}</td>
            <td>{{ $item->tgl_masuk }}</td>
            <td>{{ $item->tgl_keluar }}</td>
            <td>{{ $item->total }}</td>
        </tr>
        @php
            $total_pendapatan += $item->total; // Menambahkan total bayar ke total pendapatan
        @endphp
    @endforeach
    <tr>
        <td colspan="7" style="text-align: right;">Total Pendapatan:</td>
        <td>{{ $total_pendapatan }}</td>
    </tr>
</table>

</body>
</html>
