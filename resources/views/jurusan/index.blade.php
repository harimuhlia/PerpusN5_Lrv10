@extends('tampilan.app')
@section('title','Master Jurusan')

@section('content')

<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    Tabel Data Seluruh Jurusan

                </h3>

                <div class="card-tools">

                    <a href="{{ route('jurusan.create') }}"
                        class="btn btn-primary btn-sm">

                        <i class="fas fa-plus"></i>

                        Tambah Jurusan

                    </a>

                    <a href="{{ route('jurusan.trash') }}"
                        class="btn btn-danger btn-sm">

                        <i class="fas fa-trash"></i>

                        Trash

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

                        @forelse($jurusan as $item)

                        <tr>

                            <td class="text-center">

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $item->nama_jurusan }}

                            </td>

                            <td class="text-center">

                                <a href="{{ route('jurusan.show',$item->id) }}"
                                    class="btn btn-info btn-sm">

                                    Detail

                                </a>

                                <a href="{{ route('jurusan.edit',$item->id) }}"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <form action="{{ route('jurusan.destroy',$item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">

                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="3"
                                class="text-center">

                                Data Jurusan Masih Kosong

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