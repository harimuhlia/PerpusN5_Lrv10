@extends('tampilan.app')

@section('title','Peminjaman Manual')

@section('content')

<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-book mr-1"></i>

                    Form Peminjaman Manual

                </h3>

                <div class="card-tools">

                    <a href="{{ route('pinjam.index') }}"
                        class="btn btn-secondary btn-sm">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

            <form action="{{ route('peminjaman-manual.store') }}"
                method="POST">

                @csrf

                <div class="card-body">

                    <div class="row">

                        {{-- ID REGISTER --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    ID Register

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="input-group">

                                    <input
                                        type="text"
                                        name="id_register"
                                        id="id_register"
                                        class="form-control @error('id_register') is-invalid @enderror"
                                        placeholder="Masukkan ID Register"
                                        value="{{ old('id_register') }}"
                                        autocomplete="off">

                                    <div class="input-group-append">

                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            id="btnCari">

                                            <i class="fas fa-search"></i>

                                            Cari

                                        </button>

                                    </div>

                                </div>

                                @error('id_register')

                                <div class="invalid-feedback d-block">

                                    {{ $message }}

                                </div>

                                @enderror

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Nama Member

                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama_member"
                                    readonly>

                                <input
                                    type="hidden"
                                    name="user_id"
                                    id="user_id">

                            </div>

                        </div>
                        {{-- JURUSAN --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Jurusan

                                </label>

                                <input
                                    type="text"
                                    id="jurusan"
                                    class="form-control"
                                    readonly>

                            </div>

                        </div>

                        {{-- KELAS --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Kelas

                                </label>

                                <input
                                    type="text"
                                    id="kelas"
                                    class="form-control"
                                    readonly>

                            </div>

                        </div>

                        {{-- PILIH BUKU --}}

                        <div class="col-md-12">

                            <div class="form-group">

                                <label>

                                    Buku

                                    <span class="text-danger">*</span>

                                </label>

                                <select
                                    name="buku_id"
                                    id="buku_id"
                                    class="form-control select2 @error('buku_id') is-invalid @enderror"
                                    style="width:100%;">

                                    <option value="">

                                        -- Pilih Buku --

                                    </option>

                                    @foreach($buku as $item)

                                    <option
                                        value="{{ $item->id }}"
                                        data-kode="{{ $item->kode_buku }}"
                                        data-stok="{{ $item->stok }}">

                                        {{ $item->kode_buku }}
                                        -
                                        {{ $item->judul }}
                                        (Stok :
                                        {{ $item->stok }})
                                    </option>

                                    @endforeach

                                </select>

                                @error('buku_id')

                                <div class="invalid-feedback d-block">

                                    {{ $message }}

                                </div>

                                @enderror

                            </div>

                        </div>

                        {{-- KODE BUKU --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Kode Buku

                                </label>

                                <input
                                    type="text"
                                    id="kode_buku"
                                    class="form-control"
                                    readonly>

                            </div>

                        </div>

                        {{-- STOK BUKU --}}

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>

                                    Stok Buku

                                </label>

                                <input
                                    type="text"
                                    id="stok"
                                    class="form-control"
                                    readonly>

                            </div>

                        </div>
                                                <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah Pinjam <span class="text-danger">*</span></label>
                                <input type="number"
                                    name="jumlah"
                                    class="form-control @error('jumlah') is-invalid @enderror"
                                    value="{{ old('jumlah',1) }}"
                                    min="1"
                                    required>
                                @error('jumlah')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Durasi Pinjam (Hari) <span class="text-danger">*</span></label>
                                <input type="number"
                                    name="durasi_pinjam"
                                    class="form-control @error('durasi_pinjam') is-invalid @enderror"
                                    value="{{ old('durasi_pinjam',1) }}"
                                    min="1"
                                    required>
                                @error('durasi_pinjam')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>

                    <button type="reset" class="btn btn-warning">
                        <i class="fas fa-sync"></i> Reset
                    </button>

                    <a href="{{ route('pinjam.index') }}"
                        class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>

</section>
@endsection

@section('javascript')

<script>
$(function(){

    $('.select2').select2({
        theme:'bootstrap4'
    });

    $('#btnCari').click(function(){

        let id = $('#id_register').val();

        if(id == ''){

            alert('Masukkan ID Register.');

            $('#id_register').focus();

            return;

        }

        $.ajax({

            url:"{{ route('peminjaman-manual.searchMember') }}",

            type:'GET',

            data:{
                id_register:id
            },

            success:function(res){

                if(res.status){

                    $('#user_id').val(res.member.id);
                    $('#nama_member').val(res.member.name);
                    $('#kelas').val(res.member.kelas);
                    $('#jurusan').val(res.member.jurusan);

                }else{

                    alert(res.message);

                    $('#user_id').val('');
                    $('#nama_member').val('');
                    $('#kelas').val('');
                    $('#jurusan').val('');

                }

            },

            error:function(){

                alert('Terjadi kesalahan.');

            }

        });

    });

    $('#buku_id').change(function(){

        let option = $(this).find(':selected');

        $('#kode_buku').val(option.data('kode'));

        $('#stok').val(option.data('stok'));

    });

});

</script>

@endsection