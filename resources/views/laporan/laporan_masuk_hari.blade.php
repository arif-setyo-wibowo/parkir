@extends('layout.sidebar')
@section('content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $title}}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">{{ $title}}</li>
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
                                <div class="col-4">
                                    Cari Tanggal :
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="date" name="tanggal" class="form-control" required>
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
                                    <h4>Total Kendaraan : 1</h4>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No.</th>
                                    <th>Kendaraan</th>
                                    <th>Plat Nomer</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            
                            <tr>
                                <td>1</td>
                                <td>Mobil</td>
                                <td>W 3434 BKD</td>
                                <td>12-12-2003</td>
                                <td>70000</td>
                                <td><button type="button" class="btn btn-success btn-sm buttondelete" >
                                    Masuk</button>
                                    <button type="button" class="btn btn-primary btn-sm buttondelete" >
                                        Ubah Status</button>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>

@endsection
            