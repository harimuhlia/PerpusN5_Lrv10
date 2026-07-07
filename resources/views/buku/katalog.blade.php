@extends('tampilan.app')
@section('title','Katalog Buku')

@section('content')

<section class="content">

    <div class="container-fluid">

        {{-- Search --}}
        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-search"></i>

                    Pencarian Buku

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('buku.katalog') }}"
                    method="GET">

                    <div class="input-group">

                        <input type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Cari Judul, Pengarang, Penerbit atau Kode Buku">

                        <div class="input-group-append">

                            <button class="btn btn-primary">

                                <i class="fas fa-search"></i>

                                Cari

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        {{-- Katalog --}}
        <div class="row">

            @forelse($buku as $item)

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="card card-primary card-outline">

                    <div class="text-center pt-3">

                        @if($item->cover)

                        <img src="{{ asset('storage/'.$item->cover) }}"
                            class="img-thumbnail"
                            style="height:260px;width:180px;object-fit:cover;">

                        @else

                        <img src="{{ asset('images/no-image.png') }}"
                            class="img-thumbnail"
                            style="height:260px;width:180px;object-fit:cover;">

                        @endif

                    </div>

                    <div class="card-body">

                        <h5 class="font-weight-bold text-primary"
                            style="height:48px;overflow:hidden;">

                            {{ $item->judul }}

                        </h5>

                        <p class="text-muted mb-1">

                            <i class="fas fa-user-edit"></i>

                            {{ $item->pengarang }}

                        </p>

                        <p class="mb-1">

                            <span class="badge badge-secondary">

                                {{ $item->kategori->nama_kategori }}

                            </span>

                        </p>

                        <table class="table table-sm table-borderless mb-2">

                            <tr>

                                <td width="70">

                                    Kode

                                </td>

                                <td>

                                    : {{ $item->kode_buku }}

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    Rak

                                </td>

                                <td>

                                    : {{ $item->rak->nama_rak }}

                                </td>

                            </tr>

                            <tr>

                                <td>

                                    Stok

                                </td>

                                <td>

                                    :

                                    @if($item->stok==0)

                                    <span class="badge badge-danger">

                                        Habis

                                    </span>

                                    @elseif($item->stok<=5)

                                        <span class="badge badge-warning">

                                        {{ $item->stok }}

                                        </span>

                                        @else

                                        <span class="badge badge-success">

                                            {{ $item->stok }}

                                        </span>

                                        @endif

                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="card-footer text-center">

                        <a href="{{ route('buku.show',$item->id) }}"
                            class="btn btn-primary btn-sm btn-block">

                            <i class="fas fa-eye"></i>

                            Detail Buku

                        </a>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-12">

                <div class="alert alert-warning text-center">

                    <i class="fas fa-info-circle"></i>

                    Buku tidak ditemukan.

                </div>

            </div>

            @endforelse

        </div>

        <div class="mt-3">

            {{ $buku->appends(request()->query())->links() }}

        </div>

    </div>

</section>

@endsection