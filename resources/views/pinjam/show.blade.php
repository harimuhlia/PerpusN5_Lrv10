@extends('tampilan.app')

@section('title','Detail Peminjaman Buku')

@section('content')

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">

                <div class="card card-primary card-outline">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-book mr-1"></i>
                            Detail Peminjaman Buku
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            {{-- Cover --}}
                            <div class="col-md-4">

                                @if($pinjam->buku->cover)

                                <img src="{{ asset('storage/'.$pinjam->buku->cover) }}"
                                    class="img-fluid img-thumbnail"
                                    style="width:100%;">

                                @else

                                <div class="border text-center bg-light d-flex align-items-center justify-content-center"
                                    style="height:500px;">

                                    Tidak Ada Cover

                                </div>

                                @endif

                            </div>

                            {{-- Detail --}}
                            <div class="col-md-8">

                                <h2 class="font-weight-bold mb-1">
                                    {{ $pinjam->buku->judul }}
                                </h2>

                                <p class="text-muted mb-4">
                                    {{ $pinjam->buku->pengarang }}
                                </p>

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kode Buku</span>
                                                <span class="info-box-number">
                                                    {{ $pinjam->buku->kode_buku }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Penerbit</span>
                                                <span class="info-box-number">
                                                    {{ $pinjam->buku->penerbit }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Tahun Terbit</span>
                                                <span class="info-box-number">
                                                    {{ $pinjam->buku->tahun_terbit }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kategori</span>
                                                <span class="info-box-number">
                                                    {{ $pinjam->buku->kategori->nama_kategori }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Rak</span>
                                                <span class="info-box-number">
                                                    {{ $pinjam->buku->rak->nama_rak }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Stok Buku</span>
                                                <span class="info-box-number">
                                                    {{ $pinjam->buku->stok }}
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <hr>

                                <h4 class="mb-3">
                                    Informasi Peminjaman
                                </h4>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Peminjam</label>
                                            <input type="text" class="form-control"
                                                value="{{ $pinjam->user->name }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Durasi Pinjam</label>
                                            <input type="text" class="form-control"
                                                value="{{ $pinjam->durasi_pinjam }} Hari" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Pinjam</label>
                                            <input type="text" class="form-control"
                                                value="{{ $pinjam->tanggal_pinjam }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Kembali</label>
                                            <input type="text" class="form-control"
                                                value="{{ $pinjam->tanggal_kembali }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <br>

                                            @if($pinjam->status=='pending')
                                            <span class="badge badge-warning px-3 py-2">
                                                Pending
                                            </span>
                                            @elseif($pinjam->status=='dipinjam')
                                            <span class="badge badge-primary px-3 py-2">
                                                Dipinjam
                                            </span>
                                            @elseif($pinjam->status=='dikembalikan')
                                            <span class="badge badge-success px-3 py-2">
                                                Dikembalikan
                                            </span>
                                            @elseif($pinjam->status=='dibatalkan')
                                            <span class="badge badge-secondary px-3 py-2">
                                                Dibatalkan
                                            </span>
                                            @endif

                                        </div>
                                    </div>

                                </div>

                                <hr>

                                <h4 class="mb-3">
                                    Deskripsi Buku
                                </h4>

                                <div class="callout callout-info">

                                    {{ $pinjam->buku->deskripsi ?? 'Tidak ada deskripsi buku.' }}

                                </div>

                                <hr>

                                <div class="mt-3">
                                    <a href="{{ route('pinjam.index') }}"
                                        class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>

                                    @if(Auth::user()->role=='admin')

                                    @if($pinjam->status=='pending')

                                    <form action="{{ route('pinjam.setujui',$pinjam->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                            class="btn btn-success"
                                            onclick="return confirm('Setujui peminjaman ini?')">

                                            <i class="fas fa-check"></i>
                                            Setujui

                                        </button>

                                    </form>

                                    @endif

                                    @if($pinjam->status=='dipinjam')

                                    <form action="{{ route('pinjam.kembalikan',$pinjam->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                            class="btn btn-warning"
                                            onclick="return confirm('Buku sudah dikembalikan?')">

                                            <i class="fas fa-undo"></i>
                                            Kembalikan

                                        </button>

                                    </form>

                                    @endif

                                    @endif

                                </div>

                            </div>
                            {{-- End Detail --}}

                        </div>
                        {{-- End Row --}}

                    </div>
                    {{-- End Card Body --}}

                </div>
                {{-- End Card --}}

            </div>
        </div>

    </div>
</section>

@endsection