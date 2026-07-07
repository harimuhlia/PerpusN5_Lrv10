@extends('tampilan.app')
@section('title', 'Master Buku')

@section('content')
<section class="content">
  <div class="container-fluid">
    @include('tampilan.alert')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tabel Data Seluruh Member</h3>
        <div class="card-tools">
          <a href="{{ route('rak.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus" title="Tambah Member"></i> Tambah Rak</a>
          <a href="{{ route('rak.trash') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" title="Trash"></i> Trash</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Rak</th>
              <th>Nama Rak</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($rak as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->kode_rak }}</td>
              <td>{{ $item->nama_rak }}</td>
              <td>{{ $item->keterangan }}</td>
              <td>
                <a href="{{ route('rak.show', $item->id) }}" class="btn btn-primary btn-sm">Detail</a>
                <a href="{{ route('rak.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('rak.destroy', $item->id) }}"
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
      </div>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>No</th>
          <th>Kode Rak</th>
          <th>Nama Rak</th>
          <th>Keterangan</th>
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
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
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