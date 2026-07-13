@extends('tampilan.app')
@section('title', 'Halaman Member')

@section('content')
<section class="content">
  <div class="container-fluid">
    @include('tampilan.alert')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Data Seluruh Member</h3>
                <div class="card-tools">
                    <form action="{{ route('member.cetakMasal') }}" target="_blank" method="POST" style="display: inline-block;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-print" title="Cetak Masal"></i> Cetak Masal</button>
                    </form>
                    <a href="{{ route('member.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus" title="Tambah Member"></i> Tambah Member</a>
                    <a href="{{ route('member.trash') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" title="Trash"></i> Trash</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID Register</th>
                    <th>Nama Member</th>
                    <th>Kelas</th>
                    <th>Nomor WA</th>
                    <th>Email</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($member as $item)
                        <tr>
                            <td>{{ $item->id_register }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                            <td>{{ $item->no_wa }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('member.kartu', $item->id) }}" target="_blank" class="btn btn-success btn-sm">Cetak</a>
                                <a href="{{ route('member.show', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                <a href="{{ route('member.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('member.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        </div>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID Register</th>
                    <th>Nama Member</th>
                    <th>Kelas</th>
                    <th>Nomor WA</th>
                    <th>Email</th>
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
          $(function () {
            $("#example1").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
              "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
          });
        </script>
@endsection