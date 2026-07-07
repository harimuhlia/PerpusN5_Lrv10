@extends('tampilan.app')
@section('title', 'Tambah Kategori')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Kategori
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kategori.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <form action="{{ route('kategori.store') }}"
                method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text"
                            name="nama_kategori"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            value="{{ old('nama_kategori') }}"
                            placeholder="Masukkan Nama Kategori">
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                    <a href="{{ route('kategori.index') }}"
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