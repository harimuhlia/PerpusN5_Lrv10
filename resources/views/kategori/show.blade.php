@extends('tampilan.app')
@section('title', 'Detail Kategori')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Detail Kategori
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kategori.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Nama Kategori</th>
                        <td>{{ $kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $kategori->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diubah</th>
                        <td>{{ $kategori->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('kategori.index') }}"
                    class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('kategori.edit', $kategori->id) }}"
                    class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
</section>
@endsection