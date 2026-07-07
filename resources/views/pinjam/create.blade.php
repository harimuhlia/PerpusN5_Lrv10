@extends('tampilan.app')
@section('title', 'Form Pinjam Buku')
@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book-reader mr-2"></i>
                    Form Peminjaman Buku
                </h3>
                <div class="card-tools">
                    <a href="{{ route('katalog.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- COVER --}}
                    <div class="col-md-4 text-center">
                        @if($buku->cover)

                        <img src="{{ asset('storage/'.$buku->cover) }}"
                            class="img-fluid img-thumbnail"
                            style="max-height:500px;">
                        @else
                        <div class="border bg-light d-flex align-items-center justify-content-center"
                            style="height:500px;">
                            <span class="text-muted">
                                Tidak Ada Cover
                            </span>
                        </div>
                        @endif
                    </div>

                    {{-- DETAIL --}}
                    <div class="col-md-8">
                        <h2 class="font-weight-bold mb-3">
                            {{ $buku->judul }}
                        </h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary">
                                        <i class="fas fa-user-edit"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">
                                            Pengarang
                                        </span>
                                        <span class="info-box-number">
                                            {{ $buku->pengarang }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info">
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
                                    <span class="info-box-icon bg-warning">
                                        <i class="far fa-calendar-alt"></i>
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
                                    <span class="info-box-icon bg-secondary">
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

                        {{-- FORM --}}
                        @if($buku->stok > 0)

                        <form action="{{ route('pinjam.store') }}"
                            method="POST">

                            @csrf

                            <input type="hidden"
                                name="buku_id"
                                value="{{ $buku->id }}">

                            <div class="card mt-3">

                                <div class="card-header">

                                    <strong>
                                        <i class="fas fa-edit mr-2"></i>
                                        Form Pengajuan Peminjaman
                                    </strong>

                                </div>

                                <div class="card-body">

                                    <div class="form-group">

                                        <label>
                                            Jumlah Buku
                                        </label>

                                        <input type="number"
                                            name="jumlah"
                                            class="form-control"
                                            min="1"
                                            max="{{ $buku->stok }}"
                                            value="1"
                                            required>

                                    </div>

                                    <div class="form-group">

                                        <label>
                                            Durasi Pinjam (Hari)
                                        </label>

                                        <input type="number"
                                            name="durasi_pinjam"
                                            class="form-control"
                                            min="1"
                                            max="30"
                                            value="3"
                                            required>

                                        <small class="text-muted">
                                            Maksimal 30 hari.
                                        </small>

                                    </div>

                                </div>

                                <div class="card-footer">

                                    <button type="submit"
                                        class="btn btn-success">

                                        <i class="fas fa-paper-plane"></i>
                                        Ajukan Peminjaman

                                    </button>

                                    <a href="{{ route('katalog.index') }}"
                                        class="btn btn-secondary">

                                        <i class="fas fa-arrow-left"></i>
                                        Kembali

                                    </a>

                                </div>

                            </div>

                        </form>

                        @else

                        <div class="alert alert-danger mt-3">

                            <i class="fas fa-times-circle"></i>

                            Buku sedang tidak tersedia.

                        </div>

                        <a href="{{ route('katalog.index') }}"
                            class="btn btn-secondary">

                            <i class="fas fa-arrow-left"></i>
                            Kembali

                        </a>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection