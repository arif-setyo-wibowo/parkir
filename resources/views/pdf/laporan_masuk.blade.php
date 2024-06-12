<!DOCTYPE html>
<html>
<head>
    <title>Laporan Parkir Masuk</title>
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

<h2>Laporan Parkir Masuk</h2>

<p>Mulai Tanggal: {{ $masuk }}</p>
<p>Sampai Tanggal: {{ $masukAkhir }}</p>

<table>
    <tr>
        <th>No</th>
        <th>Nama Mobil</th>
        <th>Plat Mobil</th>
        <th>Warna Mobil</th>
        <th>Nama Pemilik</th>
        <th>No Telp</th>
        <th>Tanggal Masuk</th>
        <th>Lama Inap</th>
        <th>Total Bayar</th>
    </tr>
    {{-- @php
        $total_pendapatan = 0; // Inisialisasi total pendapatan
    @endphp --}}
    @foreach($data as $key => $item)
        <tr>
            <td width="1%">{{ $key + 1 }}</td>
            <td width="10%">{{ $item->nama_mobil }}</td>
            <td width="13%">{{ $item->plat }}</td>
            <td width="10%">{{ $item->warna }}</td>
            <td width="10%">{{ $item->nama_pemilik }}</td>
            <td width="10%">{{ $item->telp }}</td>
            <td width="15%">{{ $item->tgl_masuk }}</td>
            <td align="center">{{max(1, floor((strtotime(now()) - strtotime($item->tgl_masuk)) / 86400) + 1)}} Hari</td>
            <td width="15%">{{ 'Rp ' . number_format(max(1, now()->diffInDays($item->tgl_masuk)+1) * $item->kategori->harga, 0, ',', '.') }}</td>
        </tr>
        {{-- @php
            $total_pendapatan += $item->total; // Menambahkan total bayar ke total pendapatan
        @endphp --}}
    @endforeach
</table>

</body>
</html>
