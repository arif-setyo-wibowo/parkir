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

                    <form action="" method="get">
                        <div class="row my-3">
                            <div class="col-4">
                                Cari Tanggal :
                                <div class="row">
                                    <div class="col-10">
                                        <input type="date" name="tgl" class="form-control" value="{{request()->query('tgl', '')}}" required>
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
                                <h4>Total Kendaraan : {{ $parkir->count() }}</h4>
                            </div>
                        </div>
                    </form>
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Nama Mobil</th>
                                <th>Plat Nomer</th>
                                <th>Tanggal Masuk</th>
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
                                    <td>{{ $data->kategori->kategori }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->nama_mobil }}</td>
                                    <td>{{ $data->plat }}</td>
                                    <td>{{ (new \DateTime($data->created_at))->format('d F Y H:i:s') }}</td>
                                    <td><button type="button" class="btn {{$data->status == '0' ? 'btn-success' : 'btn-danger'}} btn-sm">
                                        {{$data->status == '0' ? 'Aktif' : 'Sudah Keluar'}}</button>
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