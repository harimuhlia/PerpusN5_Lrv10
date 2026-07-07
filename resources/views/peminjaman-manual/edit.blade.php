@extends('tampilan.app')

@section('title','Edit Peminjaman Manual')

@section('content')

<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-edit mr-1"></i>
                    Edit Peminjaman Manual
                </h3>

                <div class="card-tools">

                    <a href="{{ route('pinjam.index') }}"
                        class="btn btn-secondary btn-sm">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

            <form action="{{ route('peminjaman-manual.update', $peminjaman->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">

                        {{-- ID REGISTER --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>ID Register <span class="text-danger">*</span></label>

                                <div class="input-group">

                                    <input type="text"
                                        name="id_register"
                                        id="id_register"
                                        class="form-control"
                                        value="{{ old('id_register', $peminjaman->user->id_register ?? '') }}"
                                        autocomplete="off" readonly>

                                    <div class="input-group-append">
                                        <button type="button"
                                            class="btn btn-primary"
                                            id="btnCari">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                    </div>

                                </div>

                            </div>
                        </div>

                        {{-- NAMA MEMBER --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Nama Member</label>

                                <input type="text"
                                    id="nama_member"
                                    class="form-control"
                                    value="{{ $peminjaman->user->name ?? '' }}"
                                    readonly>

                                <input type="hidden"
                                    name="user_id"
                                    id="user_id"
                                    value="{{ old('user_id', $peminjaman->user_id) }}">

                            </div>
                        </div>

                        {{-- JURUSAN --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Jurusan</label>

                                <input type="text"
                                    id="jurusan"
                                    class="form-control"
                                    value="{{ $peminjaman->user->jurusan ?? '' }}"
                                    readonly>

                            </div>
                        </div>

                        {{-- KELAS --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Kelas</label>

                                <input type="text"
                                    id="kelas"
                                    class="form-control"
                                    value="{{ $pinjam->user->kelas ?? '' }}"
                                    readonly>

                            </div>
                        </div>

                        {{-- BUKU --}}
                        <div class="col-md-12">
                            <div class="form-group">

                                <label>Buku <span class="text-danger">*</span></label>

                                <select name="buku_id"
                                    id="buku_id"
                                    class="form-control select2"
                                    style="width:100%;">

                                    <option value="">-- Pilih Buku --</option>

                                    @foreach($buku as $item)
                                    <option value="{{ $item->id }}"
                                        data-kode="{{ $item->kode_buku }}"
                                        data-stok="{{ $item->stok }}"
                                        {{ $peminjaman->buku_id == $item->id ? 'selected' : '' }}>

                                        {{ $item->kode_buku }} - {{ $item->judul }}
                                        (Stok: {{ $item->stok }})

                                    </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        {{-- KODE BUKU --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Kode Buku</label>

                                <input type="text"
                                    id="kode_buku"
                                    class="form-control"
                                    value="{{ $peminjaman->buku->kode_buku ?? '' }}"
                                    readonly>

                            </div>
                        </div>

                        {{-- STOK --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Stok Buku</label>

                                <input type="text"
                                    id="stok"
                                    class="form-control"
                                    value="{{ $peminjaman->buku->stok ?? '' }}"
                                    readonly>

                            </div>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Jumlah Pinjam</label>

                                <input type="number"
                                    name="jumlah"
                                    class="form-control"
                                    value="{{ old('jumlah', $peminjaman->jumlah) }}"
                                    min="1">

                            </div>
                        </div>

                        {{-- DURASI --}}
                        <div class="col-md-6">
                            <div class="form-group">

                                <label>Durasi (Hari)</label>

                                <input type="number"
                                    name="durasi_pinjam"
                                    class="form-control"
                                    value="{{ old('durasi_pinjam', $peminjaman->durasi_pinjam) }}"
                                    min="1">

                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Update
                    </button>

                    <button type="reset" class="btn btn-danger">
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
            return;
        }

        $.ajax({
            url:"{{ route('peminjaman-manual.searchMember') }}",
            type:'GET',
            data:{ id_register:id },

            success:function(res){

                if(res.status){

                    $('#user_id').val(res.member.id);
                    $('#nama_member').val(res.member.name);
                    $('#kelas').val(res.member.kelas);
                    $('#jurusan').val(res.member.jurusan);

                }else{
                    alert(res.message);
                }

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