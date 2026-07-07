@extends('tampilan.app')
@section('title','Trash Kelas')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-trash mr-1"></i>
                    Data Kelas Terhapus
                </h3>
                <div class="card-tools">
                    <a href="{{ route('kelas.index') }}"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1"
                    class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Jurusan</th>
                            <th>Nama Kelas</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trash as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $item->jurusan->nama_jurusan ?? '-' }}
                            </td>
                            <td>
                                {{ $item->nama_kelas }}
                            </td>
                            <td>
                                <a href="{{ route('kelas.restore',$item->id) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fas fa-undo"></i>
                                    Restore
                                </a>
                                <form action="{{ route('kelas.forceDelete',$item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Data akan dihapus permanen. Lanjutkan?')">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                Tidak ada data di Trash.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>

                            <th>No</th>
                            <th>Jurusan</th>
                            <th>Nama Kelas</th>
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