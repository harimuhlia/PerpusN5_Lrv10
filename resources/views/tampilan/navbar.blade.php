<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        @if (Auth()->user()->role == 'admin')
          <a href="/dashboard" class="nav-link">Home</a>
        @elseif (Auth()->user()->role == 'anggota')
          <a href="/anggota/dashboard" class="nav-link">Home</a>
        @endif
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('kontak.index')}}" class="nav-link">Contact</a>
      </li>
    </ul>
  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Nama Kecamatan -->
      <h4>
        <div class="text-center">
          <img src="{{ asset('AdminLTE') }}/dist/img/logoperpus.png" alt="LogoAplikasi" class="brand-image img-fluid" height="10" width="200">
        </div>
      </h4>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>