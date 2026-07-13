@extends('tampilan.app')
@section('title', 'Halaman Katalog')

@section('content')

    <section class="content">

        <div class="container-fluid">

            {{-- Header --}}
            <div class="row mb-3">

                <div class="col-12">

                    <div class="card card-primary card-outline">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-book-open mr-2"></i>
                                Katalog Buku Perpustakaan

                            </h3>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('katalog.index') }}" method="GET">

                                <div class="input-group">

                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari judul, pengarang, penerbit atau kode buku..."
                                        value="{{ request('search') }}">

                                    <div class="input-group-append">

                                        <button type="submit" class="btn btn-primary">

                                            <i class="fas fa-search"></i>
                                            Cari

                                        </button>

                                        @if (request('search'))
                                            <a href="{{ route('katalog.index') }}" class="btn btn-secondary">

                                                Reset

                                            </a>
                                        @endif

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="card-footer">

                            <strong>

                                Total Buku :

                            </strong>

                            {{ $buku->total() }} Buku

                        </div>

                    </div>

                </div>

            </div>

            {{-- Grid Buku --}}

            <div class="row">

                @forelse($buku as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">

                        <div class="card card-outline card-primary">

                            @if ($item->cover)
                                <img src="{{ asset('storage/' . $item->cover) }}" class="card-img-top"
                                    style="height:320px; object-fit:cover;">
                            @else
                                <div class="text-center bg-light" style="height:320px; line-height:320px;">

                                    <i class="fas fa-book fa-4x text-secondary"></i>

                                </div>
                            @endif

                            <div class="card-body">

                                <h5 class="font-weight-bold text-truncate">

                                    {{ $item->judul }}

                                </h5>

                                <p class="text-muted mb-3">

                                    <i class="fas fa-user-edit mr-1"></i>

                                    {{ $item->pengarang }}

                                </p>

                                <table class="table table-sm table-borderless mb-0">

                                    <tr>

                                        <th width="35%">Kategori</th>

                                        <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>

                                    </tr>

                                    <tr>

                                        <th>Rak</th>

                                        <td>{{ $item->rak->nama_rak ?? '-' }}</td>

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

                                            @if ($item->stok > 0)
                                                <span class="badge badge-success">

                                                    {{ $item->stok }} Buku

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

                                <a href="{{ route('katalog.show', $item->id) }}" class="btn btn-primary btn-block">

                                    <i class="fas fa-book-open mr-1"></i>

                                    Detail Buku

                                </a>

                                @if (Auth::user()->role == 'anggota')
                                    @if ($item->stok > 0)
                                        <a href="{{ route('pinjam.create', $item->id) }}" class="btn btn-success btn-block">

                                            <i class="fas fa-hand-holding mr-1"></i>

                                            Pinjam Buku

                                        </a>
                                    @else
                                        <button class="btn btn-secondary btn-block" disabled>

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
            @if ($buku->hasPages())
                <div class="row">

                    <div class="col-12">

                        <div class="d-flex justify-content-center mt-3">

                            {{ $buku->withQueryString()->links() }}

                        </div>

                    </div>

                </div>
            @endif

        </div>

    </section>

@endsection
