@extends('tampilan.app')
@section('title','Tambah Jurusan')

@section('content')

<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card card-primary">

                    <div class="card-header">

                        <h3 class="card-title">

                            Form Tambah Jurusan

                        </h3>

                    </div>

                    <form action="{{ route('jurusan.store') }}"
                        method="POST">

                        @csrf

                        <div class="card-body">

                            <div class="form-group">

                                <label>

                                    Nama Jurusan

                                </label>

                                <input type="text"
                                    name="nama_jurusan"
                                    class="form-control @error('nama_jurusan') is-invalid @enderror"
                                    value="{{ old('nama_jurusan') }}"
                                    placeholder="Masukkan Nama Jurusan">

                                @error('nama_jurusan')

                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>

                                @enderror

                            </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit"
                                class="btn btn-primary">

                                <i class="fas fa-save"></i>

                                Simpan

                            </button>

                            <a href="{{ route('jurusan.index') }}"
                                class="btn btn-secondary">

                                <i class="fas fa-arrow-left"></i>

                                Kembali

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection