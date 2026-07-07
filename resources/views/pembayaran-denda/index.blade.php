@extends('tampilan.app')
@section('title','Pembayaran Denda')

@section('content')
<section class="content">
    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="row">

            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Rp {{ number_format($totalDenda,0,',','.') }}</h3>
                        <p>Total Penerimaan Denda</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalTransaksi }}</h3>
                        <p>Jumlah Pembayaran</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Rp {{ number_format($totalHariIni,0,',','.') }}</h3>
                        <p>Penerimaan Hari Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Rp {{ number_format($totalBulanIni,0,',','.') }}</h3>
                        <p>Penerimaan Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-filter mr-1"></i>
                    Filter Laporan Pembayaran Denda
                </h3>
            </div>

            <div class="card-body">

                <form action="{{ route('pembayaran-denda.index') }}" method="GET">

                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <label>Tanggal Awal</label>
                            <input type="date"
                                name="tanggal_awal"
                                class="form-control"
                                value="{{ $tanggalAwal }}">
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <label>Tanggal Akhir</label>
                            <input type="date"
                                name="tanggal_akhir"
                                class="form-control"
                                value="{{ $tanggalAkhir }}">
                        </div>

                        <div class="col-lg-6 d-flex align-items-end">

                            <button type="submit" class="btn btn-primary btn-sm mr-2">
                                <i class="fas fa-search"></i> Filter
                            </button>

                            <a href="{{ route('pembayaran-denda.index') }}"
                                class="btn btn-secondary btn-sm mr-2">
                                <i class="fas fa-sync-alt"></i> Reset
                            </a>

                            <a href="{{ route('pembayaran-denda.cetak',['tanggal_awal'=>$tanggalAwal,'tanggal_akhir'=>$tanggalAkhir]) }}"
                                target="_blank"
                                class="btn btn-success btn-sm mr-2">
                                <i class="fas fa-print"></i> Cetak
                            </a>

                            <a href="{{ route('pembayaran-denda.excel',['tanggal_awal'=>$tanggalAwal,'tanggal_akhir'=>$tanggalAkhir]) }}"
                                class="btn btn-info btn-sm">
                                <i class="fas fa-file-excel"></i> Excel
                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        <div class="card">

<div class="card-header">

    <div class="row">

        <div class="col-md-6">
            <h3 class="card-title">
                <i class="fas fa-money-check-alt mr-1"></i>
                Data Pembayaran Denda
            </h3>
        </div>

        <div class="col-md-6 text-right">

            @if(auth()->user()->role=='admin')

            <a href="{{ route('pembayaran-denda.trashed') }}"
                class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
                Trash
            </a>

            @endif

        </div>

    </div>

</div>

            <div class="card-body">

                <table id="example1" class="table table-bordered table-striped table-hover">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>
                        @forelse($pembayaran as $item)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d-m-Y') }}
                            </td>

                            <td>
                                <strong>{{ $item->pinjam->user->name }}</strong><br>
                                <small class="text-muted">
                                    {{ $item->pinjam->user->id_register ?? '-' }}
                                    |
                                    {{ $item->pinjam->user->kelas->nama_kelas ?? '-' }}
                                </small>
                            </td>

                            <td>
                                <strong>{{ $item->pinjam->buku->judul }}</strong><br>
                                <small class="text-muted">
                                    {{ $item->pinjam->buku->pengarang }}
                                </small>
                            </td>

                            <td class="text-right">
                                <span class="font-weight-bold text-success">
                                    Rp {{ number_format($item->nominal,0,',','.') }}
                                </span>
                            </td>

                            <td class="text-center">
                                @if($item->metode_pembayaran=='Tunai')
                                <span class="badge badge-success">
                                    Tunai
                                </span>
                                @elseif($item->metode_pembayaran=='Transfer')
                                <span class="badge badge-primary">
                                    Transfer
                                </span>
                                @else
                                <span class="badge badge-secondary">
                                    {{ $item->metode_pembayaran }}
                                </span>
                                @endif
                            </td>

                            <td>
                                {{ $item->petugas->name ?? '-' }}
                            </td>

                            <td class="text-center">

                                <a href="{{ route('pembayaran-denda.show',$item->id) }}"
                                    class="btn btn-info btn-sm"
                                    title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @if(auth()->user()->role=='admin')

                                <form action="{{ route('pembayaran-denda.destroy',$item->id) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus data pembayaran ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Belum ada data pembayaran denda.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                    <tfoot>

                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Peminjam</th>
                            <th>Buku</th>
                            <th>Nominal</th>
                            <th>Metode</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
                        </tr>

                    </tfoot>

                </table>

            </div>
        </div>
        <div class="row">

            <div class="col-md-12">

                <div class="alert alert-success mb-0">

                    <h5 class="mb-2">
                        <i class="fas fa-calculator"></i>
                        Ringkasan Pembayaran Denda
                    </h5>

                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <th width="250">Total Transaksi</th>
                            <td>: <strong>{{ $totalTransaksi }}</strong> Transaksi</td>
                        </tr>
                        <tr>
                            <th>Total Penerimaan Denda</th>
                            <td>: <strong>Rp {{ number_format($totalDenda,0,',','.') }}</strong></td>
                        </tr>
                        <tr>
                            <th>Penerimaan Hari Ini</th>
                            <td>: <strong>Rp {{ number_format($totalHariIni,0,',','.') }}</strong></td>
                        </tr>
                        <tr>
                            <th>Penerimaan Bulan Ini</th>
                            <td>: <strong>Rp {{ number_format($totalBulanIni,0,',','.') }}</strong></td>
                        </tr>
                    </table>

                </div>

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