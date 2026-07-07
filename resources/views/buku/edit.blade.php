@extends('tampilan.app')
@section('title', 'Edit Buku')

@section('content')
<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Edit Data Buku

                </h3>

                <div class="card-tools">

                    <a href="{{ route('buku.index') }}"
                        class="btn btn-secondary btn-sm">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

            <form action="{{ route('buku.update',$buku->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Kategori</label>

                                <select name="kategori_id"
                                    class="form-control">

                                    @foreach($kategori as $item)

                                    <option value="{{ $item->id }}"
                                        {{ $buku->kategori_id==$item->id?'selected':'' }}>

                                        {{ $item->nama_kategori }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Rak</label>

                                <select name="rak_id"
                                    class="form-control">

                                    @foreach($rak as $item)

                                    <option value="{{ $item->id }}"
                                        {{ $buku->rak_id==$item->id?'selected':'' }}>

                                        {{ $item->nama_rak }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Kode Buku</label>

                                <input type="text"
                                    name="kode_buku"
                                    value="{{ $buku->kode_buku }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Judul Buku</label>

                                <input type="text"
                                    name="judul"
                                    value="{{ $buku->judul }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Pengarang</label>

                                <input type="text"
                                    name="pengarang"
                                    value="{{ $buku->pengarang }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Penerbit</label>

                                <input type="text"
                                    name="penerbit"
                                    value="{{ $buku->penerbit }}"
                                    class="form-control">

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Tahun Terbit</label>

                                <input type="number"
                                    name="tahun_terbit"
                                    value="{{ $buku->tahun_terbit }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Stok Buku</label>

                                <input type="number"
                                    name="stok"
                                    value="{{ old('stok', $buku->stok) }}"
                                    min="0"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Cover Buku</label>

                                <div class="custom-file">

                                    <input type="file"
                                        name="cover"
                                        id="cover"
                                        class="custom-file-input">

                                    <label class="custom-file-label">

                                        Pilih Cover...

                                    </label>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-6">

                            @if($buku->cover)

                            <div class="form-group">

                                <label>Cover Saat Ini</label>

                                <br>

                                <img src="{{ asset('storage/'.$buku->cover) }}"
                                    class="img-thumbnail"
                                    width="130">

                            </div>

                            @endif

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Deskripsi</label>

                                <textarea
                                    name="deskripsi"
                                    rows="5"
                                    class="form-control">{{ $buku->deskripsi }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Update

                    </button>

                    <a href="{{ route('buku.index') }}"
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

@section('javascript')

<script>
    $(function() {

        bsCustomFileInput.init();

    });
</script>

@endsection