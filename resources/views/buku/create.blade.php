@extends('tampilan.app')
@section('title','Tambah Buku')

@section('content')
<section class="content">
    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Form Tambah Buku
                </h3>

                <div class="card-tools">

                    <a href="{{ route('buku.index') }}" class="btn btn-secondary btn-sm">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

            <form action="{{ route('buku.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>Terjadi kesalahan!</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                    @endif

                    <div class="row">

                        {{-- Kategori --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Kategori</label>

                                <select name="kategori_id"
                                    class="form-control @error('kategori_id') is-invalid @enderror">

                                    <option value="">-- Pilih Kategori --</option>

                                    @foreach($kategori as $item)

                                    <option value="{{ $item->id }}"
                                        {{ old('kategori_id')==$item->id ? 'selected' : '' }}>

                                        {{ $item->nama_kategori }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        {{-- Rak --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Rak</label>

                                <select name="rak_id"
                                    class="form-control @error('rak_id') is-invalid @enderror">

                                    <option value="">-- Pilih Rak --</option>

                                    @foreach($rak as $item)

                                    <option value="{{ $item->id }}"
                                        {{ old('rak_id')==$item->id ? 'selected' : '' }}>

                                        {{ $item->nama_rak }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        {{-- Kode Buku --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Kode Buku</label>

                                <input type="text"
                                    name="kode_buku"
                                    value="{{ old('kode_buku') }}"
                                    class="form-control @error('kode_buku') is-invalid @enderror">

                            </div>

                        </div>

                        {{-- Judul --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Judul Buku</label>

                                <input type="text"
                                    name="judul"
                                    value="{{ old('judul') }}"
                                    class="form-control @error('judul') is-invalid @enderror">

                            </div>

                        </div>

                        {{-- Pengarang --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Pengarang</label>

                                <input type="text"
                                    name="pengarang"
                                    value="{{ old('pengarang') }}"
                                    class="form-control">

                            </div>

                        </div>

                        {{-- Penerbit --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Penerbit</label>

                                <input type="text"
                                    name="penerbit"
                                    value="{{ old('penerbit') }}"
                                    class="form-control">

                            </div>

                        </div>

                        {{-- Tahun --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Tahun Terbit</label>

                                <input type="number"
                                    name="tahun_terbit"
                                    value="{{ old('tahun_terbit') }}"
                                    class="form-control">

                            </div>

                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Stok Buku</label>

                                <input type="number"
                                    name="stok"
                                    min="0"
                                    value="{{ old('stok',1) }}"
                                    class="form-control">

                            </div>

                        </div>

                        {{-- Cover --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Cover Buku</label>

                                <div class="custom-file">

                                    <input type="file"
                                        name="cover"
                                        class="custom-file-input"
                                        id="cover">

                                    <label class="custom-file-label">

                                        Pilih Cover...

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group">

                        <label>Deskripsi</label>

                        <textarea
                            name="deskripsi"
                            rows="5"
                            class="form-control">{{ old('deskripsi') }}</textarea>

                    </div>

                </div>

                <div class="card-footer">

                    <button class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Simpan

                    </button>

                    <a href="{{ route('buku.index') }}"
                        class="btn btn-secondary">

                        Batal

                    </a>

                </div>

            </form>

        </div>

    </div>
</section>
@endsection

@section('javascript')

<script>
    $(function() {

        bsCustomFileInput.init();

    });
</script>

@endsection