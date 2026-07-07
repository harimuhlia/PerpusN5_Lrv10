@extends('tampilan.app')
@section('title', 'Detail Rak')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-archive mr-1"></i>
                    Detail Rak
                </h3>
                <div class="card-tools">
                    <a href="{{ route('rak.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Kode Rak</th>
                        <td>{{ $rak->kode_rak }}</td>
                    </tr>
                    <tr>
                        <th>Nama Rak</th>
                        <td>{{ $rak->nama_rak }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>
                            {{ $rak->keterangan ?: '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $rak->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Terakhir Diubah</th>
                        <td>{{ $rak->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('rak.index') }}"
                    class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                @if(auth()->user()->role == 'admin')
                <a href="{{ route('rak.edit', $rak->id) }}"
                    class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection