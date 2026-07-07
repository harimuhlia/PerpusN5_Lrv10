@extends('tampilan.app')
@section('title', 'Master Buku')

@section('content')
<section class="content">
    <div class="container-fluid">
        @include('tampilan.alert')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tabel Data Seluruh Buku
                </h3>
                <div class="card-tools">
                    <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Buku
                    </a>

                    <a href="{{ route('buku.export') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>

                    <a href="{{ route('buku.trash') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Trash
                    </a>

                    <label class="btn btn-success btn-sm mb-0">
                        <i class="fas fa-folder-open"></i> Import Excel
                        <input type="file"
                            name="file"
                            id="file"
                            hidden
                            onchange="this.form.submit()">
                    </label>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                </div>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="90">Cover</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Rak</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($buku as $item)
                        <tr>
                            <td class="text-center">
                                @if($item->cover)
                                <img src="{{ asset('storage/'.$item->cover) }}"
                                    width="60"
                                    class="img-thumbnail">
                                @else
                                <img src="{{ asset('images/no-image.png') }}"
                                    width="60"
                                    class="img-thumbnail">
                                @endif
                            </td>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $item->pengarang }}
                                </small>
                                <br>
                                <small class="text-muted">
                                    {{ $item->kode_buku }}
                                </small>
                            </td>
                            <td>
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </td>
                            <td>
                                {{ $item->stok }}
                            </td>
                            <td>
                                {{ $item->rak->nama_rak ?? '-' }}
                            </td>
                            <td>
                                <a href="{{ route('buku.show', $item->id) }}"
                                    class="btn btn-primary btn-sm">
                                    Detail
                                </a>
                                <a href="{{ route('buku.edit', $item->id) }}"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('buku.destroy', $item->id) }}"
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
                            <td colspan="6" class="text-center">
                                Data Buku Masih Kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                    <tfoot>

                        <tr>

                            <th>Cover</th>
                            <th>Judul Buku</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Rak</th>
                            <th>Aksi</th>

                        </tr>

                    </tfoot>

                </table>

            </div>
            <!-- /.card-body -->

        </div>

    </div>

</section>

@endsection

@section('javascript')
<script>
    $("#example1").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        pageLength: 10,
        buttons: [
            "copy",
            "csv",
            "excel",
            "pdf",
            "print",
            "colvis"
        ],
        columnDefs: [{
                responsivePriority: 1,
                targets: 1 // Judul
            },
            {
                responsivePriority: 2,
                targets: 5 // Aksi
            },
            {
                responsivePriority: 3,
                targets: 0 // Cover
            }
        ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
@endsection