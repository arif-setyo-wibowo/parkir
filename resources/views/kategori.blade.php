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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
            <div class="col-12">
            <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Data Kategori</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Tambah Kategori</a>
                    </li>
                </ul>
                </div>
                <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <div class="row">
                            <div class="col-12">
                                  <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Kategori</th>
                                      <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      {{-- @foreach ($kategori as $data)
                                      <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $data->kategori}}</td>
                                        <td>
                                          <button type="button" class="btn btn-info btn-sm buttonupdate" 
                                          id="{{ $data->idKategori }}" >
                                          <i class="fas fa-pencil-alt"></i> Edit</button>
                                          &nbsp;<button type="button" class="btn btn-danger btn-sm buttondelete" id="{{ $data->idKategori }}">
                                            <i class="fas fa-trash"></i> Hapus</button>
                                        </td>
                                      </tr>
                                      @endforeach --}}
                                    </tfoot>
                                  </table>
                          </div>
                          <!-- /.row -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        <!-- form start -->
                        <form action="{{ route('kategori.tambah') }}" method="POST">
                          @csrf
                            <div class="form-group">
                              <label>Nama Kategori</label>
                              <input type="text" class="form-control" name="kategori" placeholder="Kategori">
                            </div>
                            <div class="form-group">
                              <label>Harga Parkir</label>
                              <input type="text" class="form-control" name="kategori" placeholder="Kategori">
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

  {{-- Modal Update --}}
  <div class="modal fade" id="updateKategori">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Kategori</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('kategori.update')}}" method="POST">
        @csrf
        <div class="modal-body">
              <div class="form-group">
              <label>Nama Kategori</label>
              <input type="hidden" name="IdUpdate" id="kategoriId">
              <input type="text" class="form-control" name="kategoriUpdate" id="kategoriUpdate" placeholder="Kategori">
              </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  {{-- Modal Hapus --}}
  <div class="modal fade" id="hapusData" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Yakin Menghapus Data ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-primary buttonAksiHapus">Hapus</button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Hapus --}}
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