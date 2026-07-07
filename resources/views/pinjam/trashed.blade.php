@extends('tampilan.app')
@section('title', 'Halaman Trash Peminjaman')

@section('content')
<section class="content">
    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Tabel Data Seluruh Trash Peminjaman
                </h3>

                <div class="card-tools">
                    <a href="{{ route('pinjam.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-left"></i>
                        Data Peminjaman
                    </a>
                </div>

            </div>

            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th>Judul Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th width="180">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($pinjam as $item)

                        <tr>
                            <td>{{ $item->buku->judul }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->tanggal_pinjam }}</td>
                            <td>{{ $item->tanggal_kembali }}</td>
                            <td>
                                @if($item->status == 'Dipinjam')
                                <span class="badge badge-warning">
                                    Dipinjam
                                </span>
                                @else
                                <span class="badge badge-success">
                                    Dikembalikan
                                </span>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('pinjam.restore',$item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        Restore
                                    </button>
                                </form>

                                <form action="{{ route('pinjam.forceDelete',$item->id) }}"
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

                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr>

                            <th>Judul Buku</th>
                            <th>Peminjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
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
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>
@endsection