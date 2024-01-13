<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parkir | {{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/daterangepicker/daterangepicker.css">

  {{-- Data Tables --}}
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('assets/admin/') }}/plugins/dropzone/min/dropzone.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets/admin/') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/admin/') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/admin/') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard')}}" @if ($title == 'Dashboard') class="nav-link active" @else class="nav-link" @endif>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header">Parkir</li>
          <li class="nav-item">
             <a href="{{ route('kategori')}}" @if ($title == 'Kategori Kendaraan') class="nav-link active" @else class="nav-link" @endif>
              <i class="nav-icon far fa-image"></i>
              <p>
                Kategori Kendaran
              </p>
            </a>
          </li>
          <li class="nav-item">
             <a href="{{ route('parkir')}}" @if ($title == 'Parkir Inap') class="nav-link active" @else class="nav-link" @endif>
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Parkir
              </p>
            </a>
          </li>
          <li class="nav-item">
             <a href="{{ route('users')}}" @if ($title == 'Users') class="nav-link active" @else class="nav-link" @endif>
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-header">Laporan</li>
          <li class="nav-item">
            <a href="{{ route('laporan.stay')}}" @if ($title == 'Laporan Kendaraan Inap') class="nav-link active" @else class="nav-link" @endif>

             <p>
               Laporan kendaraan inap
             </p>
           </a>
         </li>
          <li class="nav-item">
             <a href="{{ route('laporan.masuk.hari')}}" @if ($title == 'Laporan Masuk Harian Kendaraan') class="nav-link active" @else class="nav-link" @endif>

              <p>
                Laporan masuk per hari
              </p>
            </a>
          </li>
          <li class="nav-item">
             <a href="{{ route('laporan.masuk.bulan')}}" @if ($title == 'Laporan Masuk Bulanan Kendaraan') class="nav-link active" @else class="nav-link" @endif>

              <p>
                Laporan masuk per bulan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('laporan.keluar.hari')}}" @if ($title == 'Laporan Keluar Harian Kendaraan') class="nav-link active" @else class="nav-link" @endif>

             <p>
               Laporan keluar per hari
             </p>
           </a>
         </li>
         <li class="nav-item">
            <a href="{{ route('laporan.keluar.bulan')}}" @if ($title == 'Laporan Keluar Bulanan Kendaraan') class="nav-link active" @else class="nav-link" @endif>

             <p>
               Laporan keluar per bulan
             </p>
           </a>
         </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="{{ asset('assets/admin/') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/admin/') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/admin/') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/admin/') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admin/') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/') }}/dist/js/adminlte.js"></script>

<script src="{{ asset('assets/admin/') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/admin/') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/custom.js"></script>
@yield('js')
</body>
</html>
