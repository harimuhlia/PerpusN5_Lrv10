@extends('tampilan.app')
@section('title', 'Halaman Katalog')

@section('content')
<section class="content">
  <div class="container-fluid">
    <!-- Main content -->
{{-- Search --}}
<div class="card">

    <div class="card-header">
        <h3 class="card-title">

            <i class="fas fa-search mr-2"></i>

            Pencarian Buku

        </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('katalog.index') }}" method="GET">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari judul, pengarang, penerbit, kode buku..."
                       value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Grid Buku --}}
<div class="row">
    @forelse($buku as $item)
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card card-primary card-outline">
                {{-- Cover --}}
                @if($item->cover)
                    <img src="{{ asset('storage/'.$item->cover) }}"
                         class="card-img-top"
                         style="height:330px; object-fit:cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light"
                         style="height:330px;">
                        <span class="text-muted">
                            Tidak Ada Cover
                        </span>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="font-weight-bold"
                        style="height:55px; overflow:hidden;">
                        {{ $item->judul }}
                    </h5>
                    <p class="text-muted mb-3">
                        <i class="fas fa-user-edit"></i>
                        {{ $item->pengarang }}
                    </p>
                    <table class="table table-sm table-borderless mb-3">
                        <tr>
                            <th width="35%">Kategori</th>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                        </tr>
                        <tr>
                            <th>Rak</th>
                            <td>{{ $item->rak->nama_rak }}</td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td>{{ $item->kode_buku }}</td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td>{{ $item->tahun_terbit }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>
                                @if($item->stok > 0)
                                    <span class="badge badge-success">
                                        {{ $item->stok }} tersedia
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        Stok Habis
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('katalog.show',$item->id) }}"
                       class="btn btn-primary btn-block">
                        <i class="fas fa-book-open mr-1"></i>
                        Detail Buku
                    </a>
                    @if(Auth::user()->role == 'anggota')
                        @if($item->stok > 0)
                            <a href="{{ route('pinjam.create',$item->id) }}"
                               class="btn btn-success btn-block">
                                <i class="fas fa-hand-holding mr-1"></i>
                                Pinjam Buku
                            </a>
                        @else
                            <button class="btn btn-secondary btn-block"
                                    disabled>
                                <i class="fas fa-times-circle mr-1"></i>
                                Stok Habis
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                Buku tidak ditemukan.
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-end mt-3">

    {{ $buku->links() }}

</div>
</section>
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
