@extends('tampilan.app')
@section('title','Detail Pembayaran Denda')

@section('content')
<section class="content">
    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-money-check-alt mr-1"></i>
                    Detail Pembayaran Denda
                </h3>

                <div class="card-tools">
                    <a href="{{ route('pembayaran-denda.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Member</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $pembayaran->pinjam->user->name }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID Register</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $pembayaran->pinjam->user->id_register }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kelas</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $pembayaran->pinjam->user->kelas->nama_kelas ?? '-' }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $pembayaran->pinjam->buku->judul }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Pinjam</label>
                            <input type="text"
                                class="form-control"
                                value="{{ \Carbon\Carbon::parse($pembayaran->pinjam->tanggal_pinjam)->format('d-m-Y') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Dikembalikan</label>
                            <input type="text"
                                class="form-control"
                                value="{{ \Carbon\Carbon::parse($pembayaran->pinjam->tanggal_dikembalikan)->format('d-m-Y') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Bayar</label>
                            <input type="text"
                                class="form-control"
                                value="{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d-m-Y') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $pembayaran->metode_pembayaran }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nominal Pembayaran</label>
                            <input type="text"
                                class="form-control font-weight-bold text-danger"
                                value="Rp {{ number_format($pembayaran->nominal,0,',','.') }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Petugas</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $pembayaran->petugas->name }}"
                                readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control"
                                rows="3"
                                readonly>{{ $pembayaran->keterangan ?? '-' }}</textarea>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-footer">

                <a href="{{ route('pembayaran-denda.index') }}"
                    class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>

            </div>

        </div>

    </div>
</section>
@endsection