@extends('layout.sidebar')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Parkir</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Parkir</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ">
                        <?php if (session()->has('msg')) :?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="autoDismissAlert">
                            {{ session('msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif ?>
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tab-kategori" data-toggle="pill"
                                            href="#tab-kategori" role="tab" aria-controls="tab-kategori"
                                            aria-selected="true">Data Detail Parkir</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="tab-kategori" role="tabpanel"
                                        aria-labelledby="custom-tab-kategori">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">#</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Kategori</td>
                                                    <td>{{ $parkir->kategori->kategori }} = {{ $parkir->kategori->harga }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Merk</td>
                                                    <td>{{ $parkir->merk }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Mobil</td>
                                                    <td>{{ $parkir->nama_mobil }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Pemeriksaan</td>
                                                    <td>{{ strftime('%d %B %Y', strtotime($parkir->tgl_masuk)) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Plat</td>
                                                    <td>{{ $parkir->plat }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>{{ $parkir->warna }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Telp</td>
                                                    <td>{{ $parkir->telp }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Biaya Parkir</td>
                                                    <td>{{ 'Rp ' . number_format(max(1, now()->diffInDays($parkir->tgl_masuk)+1) * $parkir->kategori->harga, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gambar</td>
                                                    <td>
                                                        <a href="{{ asset('uploads/' . $parkir->gambar) }}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                                            <img width="150px"src="{{ asset('uploads/' . $parkir->gambar) }}" class="img-fluid mb-2" alt="white sample" />
                                                        </a>
                                                    </td>
                                                </tr>
                                        </table>

                                        <a class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda Yakin Ingin Check Out dengan biaya parkir sebesar {{ 'Rp ' . number_format(max(1, now()->diffInDays($parkir->tgl_masuk)+1) * $parkir->kategori->harga, 0, ',', '.') }} Kendaraan Ini?')"
                                            href="{{ route('parkir.checkout', ['id' => $parkir->idparkir]) }}">
                                            Check Out
                                        </a>

                                        <a href="{{ route('parkir') }}">
                                            <button type="button" class="btn btn-success">Kembali</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="{{ asset('assets/admin') }}/assets/js/custom/kategori.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
