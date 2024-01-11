@extends('layout.sidebar')
@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Parkir </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <div class="col-12">
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Data Parkir </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Tambah Parkir</a>
                    </li>
                </ul>
                </div>
                <div class="card-body">
                    
                <div class="tab-content" id="custom-tabs-three-tabContent">

                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
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
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                  <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Kategori Kendaraan</th>
                                      <th>Merk</th>
                                      <th>Nama Mobil</th>
                                      <th>Warna</th>
                                      <th>Plat Nomer</th>
                                      <th>Mulai Tanggal </th>
                                      <th>Harga </th>
                                      <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td>Mobil</td>
                                        <td>Honda</td>
                                        <td>Avanza</td>
                                        <td>Merah</td> 
                                        <td>W 7820 SF</td> 
                                        <td>7 Mei 2023</td> 
                                        <td>9000</td>
                                        <td>
                                          &nbsp;<button type="button" class="btn btn-success btn-sm buttondelete" >
                                             Masuk</button>
                                        </td>
                                      </tr>
                                    </tfoot>
                                  </table>
                          </div>
                          <!-- /.row -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        <!-- form start -->
                        <form action="{{ route('parkir.tambah')}}" method="post" enctype="multipart/form-data">
                          @csrf
                            <div class="form-group">
                              <label>Kategori</label>
                              <select class="form-control" name="kategori" required>
                                <option selected disabled value="">Pilih Kategori</option>
                                {{-- @foreach ($kategori as $data)
                                    <option value="{{ $data->idKategori }}">
                                        {{ $data->kategori }}</option>
                                @endforeach --}}
                              </select>
                            </div>

                            
                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" class="form-control" name="nama" placeholder="Merk" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Mobil</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Mobil" required>
                            </div>
                            <div class="form-group">
                                <label>Warna</label>
                                <input type="text" class="form-control" name="nama" placeholder="Warna" required>
                            </div>
                            <div class="form-group">
                              <label>Plat Nomer</label>
                              <input type="text" class="form-control" name="nama" placeholder="Plat Nomer" required>
                            </div>

                            
                            <div class="form-group">
                                <label>Tanggal Masuk</label>
                                <input type="date" class="form-control" name="nama" placeholder="Nama Barang" required>
                              </div>

                            <div class="form-group">
                              <label>Harga *mengikuti kategori misal belum pilih kategori disabled ae  hapusen iki  </label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga" required>
                              </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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

    <!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
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

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
@endsection