@extends('tampilan.app')
@section('title', 'Laporan Peminjaman')

@section('content')
<section class="content">
    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Laporan Peminjaman Buku
                </h3>

                <div class="card-tools">

                    <a href="{{ route('laporan.peminjaman.pdf', request()->all()) }}"
                        target="_blank"
                        class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>

                    <a href="{{ route('laporan.peminjaman.excel', request()->all()) }}"
                        class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> Excel
                    </a>

                </div>

            </div>

            <div class="card-body">

                <form method="GET">

                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Nama / ID Member</label>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    class="form-control"
                                    placeholder="Nama atau ID Member">

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Status</label>

                                <select
                                    name="status"
                                    class="form-control">

                                    <option value="">Semua Status</option>

                                    <option value="pending"
                                        {{ request('status')=='pending'?'selected':'' }}>
                                        Pending
                                    </option>

                                    <option value="dipinjam"
                                        {{ request('status')=='dipinjam'?'selected':'' }}>
                                        Dipinjam
                                    </option>

                                    <option value="dikembalikan"
                                        {{ request('status')=='dikembalikan'?'selected':'' }}>
                                        Dikembalikan
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Tanggal Awal</label>

                                <input
                                    type="date"
                                    name="tanggal_awal"
                                    value="{{ request('tanggal_awal') }}"
                                    class="form-control">

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>Tanggal Akhir</label>

                                <input
                                    type="date"
                                    name="tanggal_akhir"
                                    value="{{ request('tanggal_akhir') }}"
                                    class="form-control">

                            </div>

                        </div>

                    </div>

                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> Cari
                    </button>

                    <a href="{{ route('laporan.peminjaman') }}"
                        class="btn btn-secondary btn-sm">
                        <i class="fas fa-sync"></i> Reset
                    </a>

                </form>

                <hr>

                <table id="example1" class="table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th>Member</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($laporan as $item)

                        <tr>

                            <td>
                                <strong>{{ $item->user->name ?? '-' }}</strong><br>
                                <small>{{ $item->user->id_register ?? '-' }}</small>
                            </td>

                            <td>
                                {{ $item->buku->judul ?? '-' }}
                            </td>

                            <td>
                                {{ $item->tanggal_pinjam }}
                            </td>

                            <td>
                                {{ $item->tanggal_kembali }}
                            </td>

                            <td>

                                @if($item->status=='pending')

                                <span class="badge badge-secondary">
                                    Pending
                                </span>

                                @elseif($item->status=='dipinjam')

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

                                <strong class="text-danger">

                                    Rp {{ number_format($item->denda,0,',','.') }}

                                </strong>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr>

                            <th>Member</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>

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