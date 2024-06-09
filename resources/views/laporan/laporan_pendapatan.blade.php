@extends('layout.sidebar')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

        <div class="content">
            <div class="card card-info card-outline">
                <!-- /.content -->
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row my-3">
                            <div class="col-6">
                                Cari Berdasar Bulan dan Tahun Pendapatan:
                                <div class="row">
                                    <div class="col-4">
                                        <select name="bln" class="form-control" required>
                                            <option selected disabled value>Pilih Bulan</option>
                                            <option value="01" {{ request()->input('bln') == '01' ? 'selected' : '' }}>Januari</option>
                                            <option value="02" {{ request()->input('bln') == '02' ? 'selected' : '' }}>Februari</option>
                                            <option value="03" {{ request()->input('bln') == '03' ? 'selected' : '' }}>Maret</option>
                                            <option value="04" {{ request()->input('bln') == '04' ? 'selected' : '' }}>April</option>
                                            <option value="05" {{ request()->input('bln') == '05' ? 'selected' : '' }}>Mei</option>
                                            <option value="06" {{ request()->input('bln') == '06' ? 'selected' : '' }}>Juni</option>
                                            <option value="07" {{ request()->input('bln') == '07' ? 'selected' : '' }}>Juli</option>
                                            <option value="08" {{ request()->input('bln') == '08' ? 'selected' : '' }}>Agustus</option>
                                            <option value="09" {{ request()->input('bln') == '09' ? 'selected' : '' }}>September</option>
                                            <option value="10" {{ request()->input('bln') == '10' ? 'selected' : '' }}>Oktober</option>
                                            <option value="11" {{ request()->input('bln') == '11' ? 'selected' : '' }}>November</option>
                                            <option value="12" {{ request()->input('bln') == '12' ? 'selected' : '' }}>Desember</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <select name="thn" class="form-control" required>
                                            <option disabled value selected>Pilih Tahun</option>
                                            @for ($tahun = 2000; $tahun <= 2030; $tahun++)
                                                <option value="{{ $tahun }}" {{ request()->input('thn') == $tahun ? 'selected' : '' }}>
                                                    {{ $tahun }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">

                            </div>
                            {{-- <div class="col-3">
                                <h5>Total Kendaraan : {{ $parkir->count() }}</h5>
                                <h5>Total Pendapatan : {{ 'Rp ' . number_format($total, 0, ',', '.') }}</h5>
                            </div> --}}
                        </div>
                    </form>
                    {{-- <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Plat Nomer</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Lama Inap</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        @if ($parkir->count() == 0)
                        <tr>
                            <td colspan="7" class="text-center">Data Kosong</td>
                        </tr>
                        @else
                            @foreach ($parkir as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kategori->kategori }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->plat }}</td>
                                    <td>{{ (new \DateTime($data->tgl_masuk))->format('d F Y H:i:s') }}</td>
                                    <td>{{ (new \DateTime($data->tgl_keluar))->format('d F Y H:i:s') }}</td>
                                    <td>{{max(1, floor((strtotime($data->tgl_keluar) - strtotime($data->tgl_masuk)) / 86400) + 1)}} Hari</td>
                                    <td>{{ 'Rp ' . number_format($data->total, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
