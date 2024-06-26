@extends('layout.sidebar')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
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
                                            aria-selected="true">Data Kategori</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tab-tambah-edit" data-toggle="pill"
                                            href="#tab-tambah-edit" role="tab" aria-controls="tab-tambah-edit"
                                            aria-selected="false">Tambah & Edit Kategori</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="tab-kategori" role="tabpanel"
                                        aria-labelledby="custom-tab-kategori">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kategori as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->kategori }}</td>
                                                        <td>{{ 'Rp ' . number_format($data->harga, 0, ',', '.')}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                onclick="editKategori('{{ $data->idkategori }}','{{ $data->kategori }}','{{ $data->harga }}')">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                Edit
                                                            </button>
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Kategori? Menghapus Kategori Dapat Menghapus Seluruh Data Yang Berelasi')"
                                                                href="{{ route('delete.kategori', ['id' => $data->idkategori]) }}">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab-tambah-edit" role="tabpanel"
                                        aria-labelledby="custom-tab-tambah-edit">
                                        <form action="{{ route('kategori.store.update') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Kategori</label>
                                                <input type="text" class="form-control" id="kategori" name="kategori"
                                                    placeholder="Masukkan Kategori" required>
                                                <input type="hidden" name="idkategori" id="idkategori">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Harga</label>
                                                <input type="number" class="form-control" id="harga" name="harga"
                                                    placeholder="Masukkan Harga" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="proses" id="proses" value="Tambah"
                                                    class="btn btn-primary">
                                                    <a href="{{ route('kategori')}}" class="btn btn-danger">Kembali</a>
                                            </div>
                                        </form>
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection
