@extends('tampilan.app')
@section('title','Trash Jurusan')

@section('content')

<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Tabel Data Trash Jurusan

                </h3>

                <div class="card-tools">

                    <a href="{{ route('jurusan.index') }}"
                        class="btn btn-primary btn-sm">

                        <i class="fas fa-arrow-left"></i>

                        Data Jurusan

                    </a>

                </div>

            </div>

            <div class="card-body">

                <table id="example1"
                    class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th width="70">No</th>

                            <th>Nama Jurusan</th>

                            <th width="220">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($trash as $item)

                        <tr>

                            <td class="text-center">

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $item->nama_jurusan }}

                            </td>

                            <td class="text-center">

                                <a href="{{ route('jurusan.restore', $item->id) }}"
                                    class="btn btn-success btn-sm"
                                    onclick="return confirm('Restore data ini?')">

                                    <i class="fas fa-undo"></i>

                                    Restore

                                </a>

                                <form action="{{ route('jurusan.forceDelete',$item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus permanen data ini?')">

                                        <i class="fas fa-trash"></i>

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3"
                                class="text-center">

                                Data Trash Jurusan Masih Kosong

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                    <tfoot>

                        <tr>

                            <th>No</th>

                            <th>Nama Jurusan</th>

                            <th>Aksi</th>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection

@section('javascript')

<script>
    $(function() {

        $("#example1").DataTable({

            responsive: true,

            lengthChange: false,

            autoWidth: false,

            buttons: [

                "copy",

                "csv",

                "excel",

                "pdf",

                "print",

                "colvis"

            ]

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>

@endsection