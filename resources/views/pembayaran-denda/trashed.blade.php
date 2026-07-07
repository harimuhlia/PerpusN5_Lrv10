@extends('tampilan.app')
@section('title','Trash Pembayaran Denda')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">
                            <i class="fas fa-trash mr-1"></i>
                            Trash Pembayaran Denda
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('pembayaran-denda.index') }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1"
                    class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Member</th>
                            <th>Buku</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal</th>
                            <th>Petugas</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pembayaran as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->pinjam->user->name }}</strong><br>
                                <small class="text-muted">
                                    {{ $item->pinjam->user->id_register }}
                                </small>
                            </td>

                            <td>
                                {{ $item->pinjam->buku->judul }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d-m-Y') }}
                            </td>

                            <td>
                                <span class="text-danger font-weight-bold">
                                    Rp {{ number_format($item->nominal,0,',','.') }}
                                </span>
                            </td>

                            <td>
                                {{ $item->petugas->name }}
                            </td>

                            <td class="text-center">

                                <form action="{{ route('pembayaran-denda.restore',$item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Restore data pembayaran ini?')">
                                        <i class="fas fa-undo"></i>
                                    </button>

                                </form>

                                <form action="{{ route('pembayaran-denda.forceDelete',$item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus permanen data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7"
                                class="text-center text-muted">
                                Data trash masih kosong.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Member</th>
                            <th>Buku</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal</th>
                            <th>Petugas</th>
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