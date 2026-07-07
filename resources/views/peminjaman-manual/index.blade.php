@extends('tampilan.app')
@section('title','Peminjaman Manual')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-book-reader mr-1"></i>
                    Data Peminjaman Manual
                </h3>
                <div class="card-tools">
                    <a href="{{ route('peminjaman-manual.create') }}"
                        class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </a>
                    <a href="{{ route('peminjaman-manual.trash') }}"
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
                            <th width="50">
                                No
                            </th>
                            <th>
                                ID Register
                            </th>
                            <th>
                                Nama Member
                            </th>
                            <th>
                                Buku
                            </th>
                            <th width="80">
                                Jumlah
                            </th>
                            <th width="100">
                                Tgl Pinjam
                            </th>
                            <th width="100">
                                Kembali
                            </th>
                            <th width="120">
                                Status
                            </th>
                            <th width="170">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pinjam as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item->user->id_register }}
                            </td>
                            <td>
                                {{ $item->user->name }}
                            </td>
                            <td>
                                {{ $item->buku->judul }}
                            </td>
                            <td class="text-center">
                                {{ $item->jumlah }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>

                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>

                            <td class="text-center">
                                @if($item->status == 'pending')
                                <span class="badge badge-warning">Pending</span>
                                @elseif($item->status == 'dipinjam')
                                <span class="badge badge-primary">Dipinjam</span>
                                @elseif($item->status == 'dikembalikan')
                                <span class="badge badge-success">Dikembalikan</span>
                                @else
                                <span class="badge badge-danger">Dibatalkan</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <a href="{{ route('peminjaman-manual.show',$item->id) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('peminjaman-manual.edit',$item->id) }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('peminjaman-manual.destroy',$item->id) }}"
                                    method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection