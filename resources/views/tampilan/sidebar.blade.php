<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  @if (Auth()->user()->role == 'admin')
    <a href="/dashboard" class="brand-link">
  @elseif (Auth()->user()->role == 'anggota')
    <a href="/anggota/dashboard" class="brand-link">
  @endif
    <img src="{{ asset('adminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light"> <strong>N5</strong>-PERPUS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
          <img src="{{ asset('adminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <!-- <div class="image">
        <img src="{{ asset('fotoprofil/'. Auth()->user()->foto_profil) }}" class="img-circle elevation-2" alt="User Image">
      </div> -->
      <div class="info">
        <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth()->user()->name }}</a>
        <span class="badge badge-success">{{ ucfirst(Auth()->user()->role) }}</span>
      </div>
    </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-header">MENU UTAMA</li>  
        @if (Auth()->user()->role == 'admin')       
          <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('dashboard*')) ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @elseif (Auth()->user()->role == 'anggota')       
          <li class="nav-item">
          <a href="{{ route('anggota.dashboard') }}" class="nav-link {{ (request()->is('anggota.dashboard*')) ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        @endif
        <li class="nav-item has-treeview"> 
          @if (Auth()->user()->role == 'admin')       
          <a href="#" class="nav-link {{ (request()->is('jurusan*', 'kelas*', 'rak*', 'kategori*')) ? 'active' : '' }}">
            <i class="fas fa-server"></i>
            <p>
              Data Master
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('jurusan.index') }}" class="nav-link {{ (request()->is('jurusan*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Jurusan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('kelas.index') }}" class="nav-link {{ (request()->is('kelas*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Kelas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('rak.index') }}" class="nav-link {{ (request()->is('rak*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Rak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('kategori.index') }}" class="nav-link {{ (request()->is('kategori*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Kategori</p>
              </a>
            </li>
          </ul>
        </li>
          <li class="nav-item has-treeview">        
          <a href="#" class="nav-link {{ (request()->is('member*', 'buku*')) ? 'active' : '' }}">
            <i class="fa fa-address-book"></i>
            <p>
              Data Perpustakaan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
        
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('member.index') }}" class="nav-link {{ (request()->is('member*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Data Member</p>
              </a>
            </li>
          
            <li class="nav-item">
              <a href="{{ route('buku.index') }}" class="nav-link {{ (request()->is('buku*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Data Buku</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{ route('katalog.index') }}" class="nav-link {{ (request()->is('katalog*')) ? 'active' : '' }}">
            <i class="fa fa-book"></i>
            <p>Katalog Buku</p>
          </a>
        </li>
          <li class="nav-item has-treeview"> 
          @if (Auth()->user()->role == 'admin')       
          <a href="#" class="nav-link {{ (request()->is('pembayaran-denda*','create*','pinjam*', 'laporan*')) ? 'active' : '' }}">
            <i class="fa fa-check"></i>
            <p>
              Transaksi
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('pinjam.index') }}" class="nav-link {{ (request()->is('pinjam*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Peminjaman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('laporan.peminjaman') }}" class="nav-link {{ (request()->is('laporan*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Laporan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pembayaran-denda.index') }}" class="nav-link {{ (request()->is('pembayaran-denda*')) ? 'active' : '' }}">
                <i class="fas fa-angle-right"></i>
                <p>Pembayaran Denda</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        <li class="nav-header">PENGATURAN</li>
        <!-- <li class="nav-item">
          @if (Auth()->user()->role == 'admin')
          <li class="nav-item">
            <a href="/manageuser" class="nav-link {{ (request()->is('profil*')) ? 'active' : '' }}">
              <i class="fas fa-users-cog"></i>
              <p>Manage User</p>
            </a>
            </li>
            @endif -->
          <li class="nav-item">
            <a href="{{ route('profile.edit') }}" class="nav-link {{ (request()->is('profile*')) ? 'active' : '' }}">
              <i class="fas fa-user-friends"></i>
              <p>Profil Saya</p>
            </a>
            </li>
          @if (Auth()->user()->role == 'admin')
          <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-cogs"></i>
            <p>Setting Aplikasi</p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="nav-link">
          <button type="button" class="btn btn-danger btn-sm" id="logout-form"><i class="fas fa-sign-out-alt"></i> Logout</button>
          {{ csrf_field() }}
          </form>
        </li>
        </li>
        <br>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>