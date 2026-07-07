@extends('tampilan.app')
@section('title', 'Trash Rak')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-trash mr-1"></i>
                    Trash Data Rak
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
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Kode Rak</th>
                            <th>Nama Rak</th>
                            <th>Keterangan</th>
                            <th width="170" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trash as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_rak }}</td>
                            <td>{{ $item->nama_rak }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('rak.restore', $item->id) }}"
                                    class="btn btn-success btn-sm"
                                    onclick="return confirm('Restore data ini?')">
                                    <i class="fas fa-undo"></i>
                                </a>
                                <form action="{{ route('rak.forceDelete', $item->id) }}"
                                    method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Data akan dihapus permanen, lanjutkan?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Tidak ada data di Trash.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script>
    $(function() {
        $('#example1').DataTable({
            responsive: true,
            autoWidth: false,
            ordering: true,
            pageLength: 10,
            lengthChange: true,
            searching: true,
            info: true
        });
    });
</script>
@endsection