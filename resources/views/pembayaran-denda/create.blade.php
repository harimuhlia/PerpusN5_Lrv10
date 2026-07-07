@extends('tampilan.app')
@section('title','Pembayaran Denda')

@section('content')
<section class="content">
    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-money-bill-wave mr-1"></i>
                    Form Pembayaran Denda
                </h3>

                <div class="card-tools">
                    <a href="{{ route('pembayaran-denda.index') }}"
                       class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <form action="{{ route('pembayaran-denda.store') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="pinjam_id"
                       value="{{ $pinjam->id }}">

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Member</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $pinjam->user->name }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ID Register</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $pinjam->user->id_register }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $pinjam->user->kelas->nama_kelas ?? '-' }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Buku</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $pinjam->buku->judul }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Kembali</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ \Carbon\Carbon::parse($pinjam->tanggal_kembali)->format('d-m-Y') }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Denda</label>
                                <input type="text"
                                       class="form-control font-weight-bold text-danger"
                                       value="Rp {{ number_format($pinjam->denda,0,',','.') }}"
                                       readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nominal Bayar <span class="text-danger">*</span></label>
                                <input type="number"
                                       name="nominal"
                                       class="form-control @error('nominal') is-invalid @enderror"
                                       value="{{ old('nominal',$pinjam->denda) }}"
                                       required>

                                @error('nominal')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Bayar <span class="text-danger">*</span></label>
                                <input type="date"
                                       name="tanggal_bayar"
                                       class="form-control @error('tanggal_bayar') is-invalid @enderror"
                                       value="{{ old('tanggal_bayar',date('Y-m-d')) }}"
                                       required>

                                @error('tanggal_bayar')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode_pembayaran"
                                        class="form-control">
                                    <option value="Tunai">Tunai</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan"
                                          rows="3"
                                          class="form-control">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>

                    <button type="reset"
                            class="btn btn-warning">
                        <i class="fas fa-sync"></i>
                        Reset
                    </button>

                    <a href="{{ route('pembayaran-denda.index') }}"
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>
</section>
@endsection