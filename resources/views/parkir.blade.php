@extends('layout.sidebar')
@section('content')
<style>
    /* Penyesuaian CSS untuk gambar */
    #camera-view {
        width: 100%;
        height: auto;
    }

    #capturedImage {
        width: 100%;
        height: auto;
    }
</style>
<div id="myModal" class="modal">
    <!-- Konten modal -->
    <div class="modal-content">
        <!-- Tombol untuk menutup modal -->
        <span class="close">&times;</span>
        <!-- Gambar hasil tangkapan -->
        <img id="capturedImage" src="" alt="Captured Image">
    </div>
</div>
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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                            href="#custom-tabs-three-home" role="tab"
                                            aria-controls="custom-tabs-three-home" aria-selected="true">Data Parkir </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-three-profile" role="tab"
                                            aria-controls="custom-tabs-three-profile" aria-selected="false">Tambah
                                            Parkir</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="tab-pasien" role="tabpanel"
                                        aria-labelledby="custom-tab-pasien">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kategori Kendaraan</th>
                                                    <th>Plat Nomer</th>
                                                    <th>Merk</th>
                                                    <th>Nama Mobil</th>
                                                    <th>Warna</th>
                                                    <th>Telp</th>
                                                    <th>Mulai Tanggal </th>
                                                    <th>Harga </th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($parkir as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->kategori->kategori }}</td>
                                                        <td>{{ $data->plat }}</td>
                                                        <td>{{ $data->merk }}</td>
                                                        <td>{{ $data->nama_mobil }}</td>
                                                        <td>{{ $data->warna }}</td>
                                                        <td>{{ $data->telp }}</td>
                                                        <td>{{ (new \DateTime($data->tgl_masuk))->format('d F Y H:i:s') }}
                                                        </td>
                                                        <td>{{ 'Rp ' . number_format(max(1, now()->diffInDays($data->tgl_masuk)+1) * $data->kategori->harga, 0, ',', '.') }}
                                                        </td>
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
                                                </tfoot>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-three-profile-tab">
                                        <!-- form start -->
                                        <form action="{{ route('parkir.tambah') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select class="form-control" name="idkategori" required>
                                                    <option selected disabled value="">Pilih Kategori</option>
                                                    @foreach ($kategori as $data)
                                                        <option value="{{ $data->idkategori }}">
                                                            {{ $data->kategori }} -
                                                            {{ 'Rp ' . number_format($data->harga, 0, ',', '.') }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Merk</label>
                                                <input type="text" class="form-control" id="merk" name="merk"
                                                    placeholder="Merk" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Mobil</label>
                                                <input type="text" class="form-control" id="nama_mobil" name="nama_mobil"
                                                    placeholder="Nama Mobil" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Warna</label>
                                                <input type="text" class="form-control" name="warna" id="warna"
                                                    placeholder="Warna" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Plat Nomer</label>
                                                <input type="text" class="form-control" name="plat" id="plat"
                                                    placeholder="Plat Nomer" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Telp</label>
                                                <input type="number" class="form-control" name="telp" id="telp" placeholder="Telp" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Pemilik</label>
                                                <input type="text" class="form-control" name="nama_pemilik" id="telp"
                                                    placeholder="Telp" required>
                                            </div>
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                                Ambil Foto
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal-default">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <!-- Header Modal -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Preview Foto</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <!-- Body Modal -->
                                                        <div class="modal-body">
                                                            <!-- Tampilan kamera -->
                                                            <video id="camera-view" autoplay playsinline></video>
                                                        </div>

                                                        <!-- Footer Modal -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                                            <button type="button" class="btn btn-primary" id="captureButton">Ambil Gambar</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>

                                            <!-- Input hidden untuk menyimpan gambar -->
                                            <input type="hidden" name="foto" id="foto">
                                            <input type="hidden" name="fotoData" id="fotoData">

                                            <div class="form-group">
                                                <input type="submit" name="proses" id="proses" value="Tambah"
                                                    class="btn btn-primary mt-5">
                                                    <a href="{{ route('parkir')}}" class="btn btn-danger">Kembali</a>
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
        $(document).ready(function() {
            $('#modal-default').on('shown.bs.modal', function () {
                var video = document.getElementById('camera-view');
                var constraints = { video: { facingMode: "environment" }, audio: false };

                navigator.mediaDevices.getUserMedia(constraints)
                .then(function(mediaStream) {
                    video.srcObject = mediaStream;
                })
                .catch(function(err) {
                    console.log('Gagal membuka kamera: ', err);
                });
            });

            // Tangkap gambar saat tombol "Ambil Gambar" diklik
            $('#captureButton').on('click', function() {
                var video = document.getElementById('camera-view');
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                var imageData = canvas.toDataURL('image/png');

                // Menghasilkan nama file acak
                var randomFileName = Math.random().toString(36).substring(7) + '.png';

                // Simpan nama file acak dalam input hidden
                var fotoInput = document.getElementById('foto');
                fotoInput.value = randomFileName;

                // Simpan data URI gambar dalam input hidden
                var fotoDataInput = document.getElementById('fotoData');
                fotoDataInput.value = imageData;

                // Tutup modal
                $('#modal-default').modal('hide');
                $('.modal-backdrop').remove();
            });

            // Tutup modal, hentikan kamera
            $('#modal-default').on('hidden.bs.modal', function () {
                var video = document.getElementById('camera-view');
                if (video.srcObject) {
                    video.srcObject.getTracks().forEach(track => track.stop());
                }
            });
        });


    </script>
@endsection
