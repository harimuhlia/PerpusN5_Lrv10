@extends('tampilan.app')

@section('title', 'Detail Buku')

@section('content')

<section class="content">
    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card card-primary card-outline">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book mr-2"></i>Detail Buku
                </h3>

                <div class="card-tools">
                    <a href="{{ route('katalog.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="row">

                    {{-- Cover --}}
                    <div class="col-md-4 text-center">

                        @if($buku->cover)

                            <img src="{{ asset('storage/'.$buku->cover) }}"
                                 class="img-fluid img-thumbnail"
                                 style="max-height:520px;">

                        @else

                            <div class="border d-flex align-items-center justify-content-center bg-light"
                                 style="height:520px;">

                                <span class="text-muted">
                                    Tidak Ada Cover
                                </span>

                            </div>

                        @endif

                    </div>

                    {{-- Detail --}}
                    <div class="col-md-8">

                        <h2 class="font-weight-bold mb-2">
                            {{ $buku->judul }}
                        </h2>

                        <h5 class="text-muted mb-4">
                            {{ $buku->pengarang }}
                        </h5>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="info-box">

                                    <span class="info-box-icon bg-primary">
                                        <i class="fas fa-barcode"></i>
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            Kode Buku
                                        </span>

                                        <span class="info-box-number">
                                            {{ $buku->kode_buku }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="info-box">

                                    <span class="info-box-icon bg-success">
                                        <i class="fas fa-tags"></i>
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            Kategori
                                        </span>

                                        <span class="info-box-number">
                                            {{ $buku->kategori->nama_kategori }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="info-box">

                                    <span class="info-box-icon bg-warning">
                                        <i class="fas fa-layer-group"></i>
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            Rak Buku
                                        </span>

                                        <span class="info-box-number">
                                            {{ $buku->rak->nama_rak }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="info-box">

                                    <span class="info-box-icon bg-info">
                                        <i class="fas fa-calendar"></i>
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            Tahun Terbit
                                        </span>

                                        <span class="info-box-number">
                                            {{ $buku->tahun_terbit }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="info-box">

                                    <span class="info-box-icon bg-secondary">
                                        <i class="fas fa-building"></i>
                                    </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            Penerbit
                                        </span>

                                        <span class="info-box-number">
                                            {{ $buku->penerbit }}
                                        </span>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="info-box">

                                    @if($buku->stok > 0)

                                        <span class="info-box-icon bg-success">
                                            <i class="fas fa-check"></i>
                                        </span>

                                    @else

                                        <span class="info-box-icon bg-danger">
                                            <i class="fas fa-times"></i>
                                        </span>

                                    @endif

                                    <div class="info-box-content">

                                        <span class="info-box-text">
                                            Stok Buku
                                        </span>

                                        <span class="info-box-number">

                                            @if($buku->stok > 0)

                                                {{ $buku->stok }} tersedia

                                            @else

                                                Stok Habis

                                            @endif

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- Deskripsi --}}
                        <div class="card mt-3">

                            <div class="card-header bg-light">
                                <strong>
                                    <i class="fas fa-book-open mr-2"></i>
                                    Deskripsi Buku
                                </strong>
                            </div>

                            <div class="card-body">

                                {{ $buku->deskripsi ?? 'Tidak ada deskripsi buku.' }}

                            </div>

                        </div>

                        {{-- Tombol --}}
                        <div class="mt-4">

                            <a href="{{ route('katalog.index') }}"
                               class="btn btn-secondary">

                                <i class="fas fa-arrow-left"></i>
                                Kembali

                            </a>

                            @if(auth()->user()->role == 'anggota')

                                @if($buku->stok > 0)

                                    <a href="{{ route('pinjam.create', $buku->id) }}"
                                       class="btn btn-success">

                                        <i class="fas fa-book-reader"></i>
                                        Pinjam Buku

                                    </a>

                                @else

                                    <button class="btn btn-danger" disabled>

                                        <i class="fas fa-times-circle"></i>
                                        Stok Habis

                                    </button>

                                @endif

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection