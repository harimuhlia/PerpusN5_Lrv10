@extends('tampilan.app')
@section('title', 'Master Kategori')

@section('content')
<section class="content">
    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Data Kategori
                </h3>

                <div class="card-tools">

                    <a href="{{ route('kategori.create') }}"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>

                    <a href="{{ route('kategori.trash') }}"
                        class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Trash
                    </a>

                </div>

            </div>

            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Kategori</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($kategori as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->nama_kategori }}</td>

                            <td>

                                <a href="{{ route('kategori.show', $item->id) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('kategori.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('kategori.destroy', $item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3" class="text-center">

                                Data kategori belum tersedia.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
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
            ordering: true,
            info: true,
            paging: true,
            searching: true,
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