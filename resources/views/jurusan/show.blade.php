@extends('tampilan.app')
@section('title','Detail Jurusan')

@section('content')

<section class="content">

    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card card-primary">

                    <div class="card-header">

                        <h3 class="card-title">

                            Detail Data Jurusan

                        </h3>

                        <div class="card-tools">

                            <a href="{{ route('jurusan.index') }}"
                                class="btn btn-secondary btn-sm">

                                <i class="fas fa-arrow-left"></i>

                                Kembali

                            </a>

                        </div>

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>

                                <th width="250">

                                    Nama Jurusan

                                </th>

                                <td>

                                    {{ $jurusan->nama_jurusan }}

                                </td>

                            </tr>

                        </table>

                    </div>

                    <div class="card-footer">

                        <a href="{{ route('jurusan.edit',$jurusan->id) }}"
                            class="btn btn-warning">

                            <i class="fas fa-edit"></i>

                            Edit

                        </a>

                        <a href="{{ route('jurusan.index') }}"
                            class="btn btn-secondary">

                            <i class="fas fa-arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection