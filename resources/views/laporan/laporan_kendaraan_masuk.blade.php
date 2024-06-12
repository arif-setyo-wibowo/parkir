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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                <?php if (session()->has('msg')) :?>
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    id="autoDismissAlert">
                    {{ session('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif ?>
                <div class="card-body">

                    <form action="{{ url('/' . session('user.role') . '/laporan/masuk-pdf') }}" target="_blank">
                        <div class="row my-3">
                            <div class="col-4">
                                Cari Tanggal Masuk :
                                <div class="row">
                                    <div class="col-5">
                                        <input type="date" name="tgl_masuk" class="form-control" required>
                                    </div>
                                    <div class="col-5">
                                        <input type="date" name="tgl_masuk_akhir" class="form-control" required>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">

                            </div>
                            <div class="col-3">
                                <h5>Total Kendaraan : {{ $parkir->count() }}</h5>
                                {{-- <h5>Total Pendapatan : {{ 'Rp ' . number_format($total, 0, ',', '.') }}</h5> --}}
                            </div>
                        </div>
                    </form>
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th>Plat Nomer</th>
                                <th>Harga per Malam</th>
                                <th>Lama Inap</th>
                                <th>Merk</th>
                                <th>Kategori</th>
                                <th>Tanggal Masuk</th>
                                <th>Total</th>
                                <th>Status</th>
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
                                    <td>{{ $data->plat }}</td>
                                    <td>{{ $data->kategori->harga }}</td>
                                    <td>{{ (new \DateTime($data->tgl_masuk))->format('d F Y H:i:s') }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->kategori->kategori }}</td>
                                    {{-- <td>{{ (new \DateTime($data->tgl_keluar))->format('d F Y H:i:s') }}</td> --}}
                                    <td align="center">{{max(1, floor((strtotime(now()) - strtotime($data->tgl_masuk)) / 86400) + 1)}} Hari</td>
                                    <td>{{ 'Rp ' . number_format((floor((strtotime(now()) - strtotime($data->tgl_masuk)) / 86400) + 1) * $data->kategori->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('parkir.detail', $data->idparkir)}}" class="btn btn-success btn-sm">cek data</a>
                                        <a class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda Yakin Ingin Check Out dengan biaya parkir sebesar {{ 'Rp ' . number_format(max(1, now()->diffInDays($data->tgl_masuk)+1) * $data->kategori->harga, 0, ',', '.') }} Kendaraan Ini?')"
                                            href="{{ route('parkir.checkout', ['id' => $data->idparkir]) }}">
                                            Check Out
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
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
