@extends('tampilan.app')
@section('title', 'Edit Rak')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit mr-1"></i>
                    Edit Rak
                </h3>
                <div class="card-tools">
                    <a href="{{ route('rak.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <form action="{{ route('rak.update', $rak->id) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Kode Rak <span class="text-danger">*</span></label>
                        <input type="text"
                            name="kode_rak"
                            class="form-control @error('kode_rak') is-invalid @enderror"
                            value="{{ old('kode_rak', $rak->kode_rak) }}"
                            placeholder="Masukkan Kode Rak">
                        @error('kode_rak')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Rak <span class="text-danger">*</span></label>
                        <input type="text"
                            name="nama_rak"
                            class="form-control @error('nama_rak') is-invalid @enderror"
                            value="{{ old('nama_rak', $rak->nama_rak) }}"
                            placeholder="Masukkan Nama Rak">
                        @error('nama_rak')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea
                            name="keterangan"
                            rows="4"
                            class="form-control @error('keterangan') is-invalid @enderror"
                            placeholder="Masukkan Keterangan">{{ old('keterangan', $rak->keterangan) }}</textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit"
                        class="btn btn-warning">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                    <button type="reset"
                        class="btn btn-secondary">
                        <i class="fas fa-sync"></i>
                        Reset
                    </button>
                    <a href="{{ route('rak.index') }}"
                        class="btn btn-danger">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection