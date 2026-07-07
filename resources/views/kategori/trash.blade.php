@extends('tampilan.app')

@section('title', 'Trash Kategori')

@section('content')

<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Trash Kategori
                </h3>

                <div class="card-tools">

                    <a href="{{ route('kategori.index') }}"
                        class="btn btn-secondary btn-sm">

                        <i class="fas fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover">

                        <thead>

                            <tr>
                                <th width="60">No</th>
                                <th>Nama Kategori</th>
                                <th width="170" class="text-center">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($trash as $item)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $item->nama_kategori }}</td>

                                <td class="text-center">

                                    <a href="{{ route('kategori.restore', $item->id) }}"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Restore data ini?')">

                                        <i class="fas fa-undo"></i>

                                    </a>

                                    <form action="{{ route('kategori.forceDelete', $item->id) }}"
                                        method="POST"
                                        style="display:inline-block;">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Data akan dihapus permanen. Lanjutkan?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="3" class="text-center text-muted">

                                    Tidak ada data di Trash.

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection