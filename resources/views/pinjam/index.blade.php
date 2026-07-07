@extends('tampilan.app')
@section('title','Data Peminjaman')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Daftar Peminjaman Buku Perpustakaan
                </h3>
                <div class="card-tools">
                    @if(auth()->user()->role=='admin')
                    <a href="{{ route('peminjaman-manual.create') }}"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Pinjam Manual
                    </a>
                    @endif
                    @if(auth()->user()->role=='admin')
                    <a href="{{ route('pinjam.trashed') }}"
                        class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                        Trash
                    </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <form method="GET"
                    action="{{ route('pinjam.index') }}">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text"
                                    name="search"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="Cari Nama Member / Judul Buku / Status">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <table id="example1"
                    class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <!-- <th width="80">
                                Cover
                            </th> -->
                            <th>
                                Buku
                            </th>
                            <th>
                                Peminjam
                            </th>
                            <th width="120">
                                Kelas
                            </th>
                            <th width="170">
                                Tanggal
                            </th>
                            <th width="80">
                                Durasi
                            </th>
                            <th width="70">
                                Jumlah
                            </th>
                            <th width="110">
                                Status
                            </th>
                            <th width="120">
                                Denda
                            </th>
                            <th width="120">
                                Status Denda
                            </th>
                            <th width="260">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pinjam as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <!-- <td class="text-center">
                                @if($item->buku->cover)
                                <img src="{{ asset('storage/'.$item->buku->cover) }}"
                                    class="img-thumbnail"
                                    style="width:70px;height:90px;object-fit:cover;">
                                @else
                                <div class="bg-secondary text-white text-center"
                                    style="width:70px;height:90px;line-height:90px;">
                                    No Cover
                                </div>
                                @endif
                            </td> -->
                            <td>
                                <strong>
                                    {{ $item->buku->judul }}
                                </strong>
                                <br>
                                <small class="text-muted">
                                    {{ $item->buku->pengarang }}
                                </small>
                            </td>
                            <td>
                                <strong>
                                    {{ $item->user->name }}
                                </strong>
                                <br>
                                <small class="text-muted">
                                    {{ $item->user->id_register ?? '-' }}
                                </small>
                            </td>
                            <td>
                                {{ $item->user->kelas->nama_kelas ?? '-' }}
                            </td>
                            <td>
                                <small>
                                    <strong>Pinjam</strong>
                                    <br>
                                    {{ $item->tanggal_pinjam }}
                                    <hr class="my-1">
                                    <strong>Kembali</strong>
                                    <br>
                                    {{ $item->tanggal_kembali }}

                                </small>
                            </td>
                            <td class="text-center">
                                {{ $item->durasi_pinjam }} Hari
                            </td>
                            <td class="text-center">
                                {{ $item->jumlah }}
                            </td>
                            <td class="text-center">
                                @if($item->status=='pending')
                                <span class="badge badge-warning">
                                    Pending
                                </span>
                                @elseif($item->status=='dipinjam')
                                <span class="badge badge-primary">
                                    Dipinjam
                                </span>
                                @elseif($item->status=='dikembalikan')
                                <span class="badge badge-success">
                                    Dikembalikan
                                </span>
                                @elseif($item->status=='dibatalkan')
                                <span class="badge badge-secondary">
                                    Dibatalkan
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->denda_otomatis > 0)
                                <span class="text-danger font-weight-bold">
                                    Rp {{ number_format($item->denda_otomatis,0,',','.') }}
                                </span>
                                @else
                                <span class="text-success">Rp 0</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($item->denda_otomatis==0)
                                <span class="badge badge-success">Tidak Ada</span>
                                @elseif($item->pembayaranDenda)
                                <span class="badge badge-primary">Lunas</span>
                                @else
                                <span class="badge badge-danger">Belum Dibayar</span>
                                @endif
                            </td>

                            <td class="text-center">

                                <a href="{{ route('pinjam.show',$item->id) }}" class="btn btn-info btn-sm mb-1" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @if(auth()->user()->role=='admin' && $item->status=='pending')
                                <a href="{{ route('peminjaman-manual.edit',$item->id) }}" class="btn btn-warning btn-sm mb-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif

                                @if($item->status=='pending')
                                <form action="{{ route('pinjam.batal',$item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-secondary btn-sm mb-1" onclick="return confirm('Batalkan peminjaman ini?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif

                                @if(auth()->user()->role=='admin' && $item->status=='pending')
                                <form action="{{ route('pinjam.setujui',$item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm mb-1" onclick="return confirm('Setujui peminjaman ini?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                @if(auth()->user()->role=='admin' && $item->status=='dipinjam')
                                <form action="{{ route('pinjam.kembalikan',$item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm mb-1" onclick="return confirm('Buku sudah dikembalikan?')">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                                @endif

                                @if(auth()->user()->role=='admin' && $item->status=='dikembalikan' && $item->denda_otomatis>0)

                                @if(!$item->pembayaranDenda)
                                <a href="{{ route('pembayaran-denda.create',$item->id) }}" class="btn btn-primary btn-sm mb-1" title="Bayar Denda">
                                    <i class="fas fa-money-bill-wave"></i>
                                </a>
                                @else
                                <a href="{{ route('pembayaran-denda.show',$item->pembayaranDenda->id) }}" class="btn btn-success btn-sm mb-1" title="Sudah Dibayar">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                                @endif

                                @endif

                                @if(auth()->user()->role=='admin')
                                <form action="{{ route('pinjam.destroy',$item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="12" class="text-center text-muted">
                                Belum ada data peminjaman.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>No</th>
                            <!-- <th>Cover</th> -->
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Durasi</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Status Denda</th>
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
$(function () {

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
        ],
        language: {
            emptyTable: "Belum ada data peminjaman.",
            zeroRecords: "Data tidak ditemukan",
            search: "Cari :",
            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

});
</script>
@endsection