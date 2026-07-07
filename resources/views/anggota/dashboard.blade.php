@extends('tampilan.app')
@section('title', 'Dashboard Anggota')
@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        {{-- Welcome --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold mb-1">

                            Selamat Datang,
                            {{ auth()->user()->name }}

                        </h3>
                        <p class="text-muted mb-0">
                            Anda login sebagai
                            <strong>{{ ucfirst(auth()->user()->role) }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $dipinjam }}</h3>
                        <p>Buku Dipinjam</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $dikembalikan }}</h3>
                        <p>Buku Dikembalikan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>

                            Rp {{ number_format($denda,0,',','.') }}

                        </h3>
                        <p>Total Denda</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Menu Cepat --}}
        <div class="row">

            {{-- Katalog --}}
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-book mr-2"></i>
                            Katalog Buku
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Lihat daftar buku yang tersedia di perpustakaan.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('katalog.index') }}"
                           class="btn btn-primary btn-block">
                            <i class="fas fa-search mr-1"></i>
                            Lihat Buku
                        </a>
                    </div>
                </div>
            </div>

            {{-- Peminjaman --}}
            <div class="col-md-4">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-book-open mr-2"></i>
                            Peminjaman Saya
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Melihat status peminjaman dan pengembalian buku.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('pinjam.index') }}"
                           class="btn btn-success btn-block">
                            <i class="fas fa-eye mr-1"></i>
                            Lihat Data
                        </a>
                    </div>
                </div>
            </div>

            {{-- Profil --}}
            <div class="col-md-4">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user mr-2"></i>
                            Profil Saya
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Kelola informasi akun dan ganti password Anda.
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('profile.edit') }}"
                           class="btn btn-warning btn-block text-white">
                            <i class="fas fa-user-edit mr-1"></i>
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat Peminjaman --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">

                            Riwayat Peminjaman

                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pinjam as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->buku->judul }}</td>
                                        <td>{{ $item->tanggal_pinjam }}</td>
                                        <td>{{ $item->tanggal_kembali }}</td>
                                        <td>
                                             @if($item->status=='pending')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock"></i>Pending
                                            </span>
                                        @elseif($item->status=='dipinjam')
                                            <span class="badge badge-primary">
                                                <i class="fas fa-book-open"></i>Dipinjam
                                            </span>
                                        @elseif($item->status=='dikembalikan')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i>Dikembalikan
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
        <script>
          $(function () {
            $("#example1").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
@endsection