<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PERPUS N5 | @yield('title')</title>

  @include('tampilan.style')
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('tampilan.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('tampilan.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('title')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @if(auth()->user()->role == 'admin')
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                  @endif
                  @if(auth()->user()->role == 'anggota')
                    <li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}">Home</a></li>
                @endif
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('tampilan.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
  @include('tampilan.script')
</body>
</html>