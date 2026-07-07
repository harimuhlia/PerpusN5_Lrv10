@extends('tampilan.app')
@section('title','Tambah Kelas')

@section('content')

<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-plus-circle mr-1"></i>
                    Tambah Data Kelas
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kelas.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <form action="{{ route('kelas.store') }}"
                method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jurusan <span class="text-danger">*</span></label>
                                <select name="jurusan_id"
                                    class="form-control @error('jurusan_id') is-invalid @enderror">
                                    <option value="">
                                        -- Pilih Jurusan --
                                    </option>
                                    @foreach($jurusan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('jurusan_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_jurusan }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Kelas <span class="text-danger">*</span></label>
                                <input type="text"
                                    name="nama_kelas"
                                    value="{{ old('nama_kelas') }}"
                                    class="form-control @error('nama_kelas') is-invalid @enderror"
                                    placeholder="Masukkan Nama Kelas">
                                @error('nama_kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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
                        <i class="fas fa-undo"></i>
                        Reset
                    </button>
                    <a href="{{ route('kelas.index') }}"
                        class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection