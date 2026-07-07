@extends('tampilan.app')
@section('title', 'Detail Member')

@section('content')
<section class="content">
  <div class="container-fluid">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ asset('adminLTE') }}/dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{ $member->name }}</h3>
                <p class="text-muted text-center">{{ $member->id_register }} ({{ ucfirst($member->role) }})</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{ $member->email }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Kelas</b> <a class="float-right">{{ $member->kelas->nama_kelas }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nomor WhatsApp</b> <a class="float-right">{{ $member->no_wa }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Alamat</b> <a class="float-right">{{ $member->alamat }}</a>
                  </li>
                </ul>

                <a href="/member" class="btn btn-primary btn-block"><b>Kembali</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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