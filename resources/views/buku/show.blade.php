@extends('tampilan.app')
@section('title','Detail Buku')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Detail Data Buku

                </h3>

                <div class="card-tools">

                    <a href="{{ route('buku.index') }}"
                        class="btn btn-secondary btn-sm">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 text-center">

                        @if($buku->cover)

                        <img src="{{ asset('storage/'.$buku->cover) }}"
                            class="img-thumbnail mb-3"
                            style="width:220px;">

                        @else

                        <img src="{{ asset('images/no-image.png') }}"
                            class="img-thumbnail mb-3"
                            style="width:220px;">

                        @endif

                    </div>

                    <div class="col-md-9">

                        <table class="table table-bordered">

                            <tr>

                                <th width="220">
                                    Kode Buku
                                </th>

                                <td>

                                    {{ $buku->kode_buku }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Judul Buku

                                </th>

                                <td>

                                    <strong>

                                        {{ $buku->judul }}

                                    </strong>

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Pengarang

                                </th>

                                <td>

                                    {{ $buku->pengarang }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Penerbit

                                </th>

                                <td>

                                    {{ $buku->penerbit }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Tahun Terbit

                                </th>

                                <td>

                                    {{ $buku->tahun_terbit }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Kategori

                                </th>

                                <td>

                                    {{ $buku->kategori->nama_kategori }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Rak

                                </th>

                                <td>

                                    {{ $buku->rak->nama_rak }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Stok

                                </th>

                                <td>

                                    @if($buku->stok > 0)

                                    <span class="badge badge-success">

                                        {{ $buku->stok }} Buku

                                    </span>

                                    @else

                                    <span class="badge badge-danger">

                                        Habis

                                    </span>

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Deskripsi

                                </th>

                                <td>

                                    {!! nl2br(e($buku->deskripsi)) !!}

                                </td>

                            </tr>

                        </table>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <a href="{{ route('buku.edit',$buku->id) }}"
                    class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="{{ route('buku.index') }}"
                    class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</section>

@endsection