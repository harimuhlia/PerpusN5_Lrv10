@extends('tampilan.app')
@section('title','Detail Kelas')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-school mr-1"></i>
                    Detail Kelas
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kelas.index') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <a href="{{ route('kelas.edit',$kela->id) }}"
                        class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ID Kelas</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $kela->id }}"
                                readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jurusan</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $kela->jurusan->nama_jurusan }}"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Kelas</label>
                            <input type="text"
                                class="form-control"
                                value="{{ $kela->nama_kelas }}"
                                readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('kelas.index') }}"
                    class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('kelas.edit',$kela->id) }}"
                    class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    Edit Data
                </a>
            </div>
        </div>
    </div>
</section>
@endsection