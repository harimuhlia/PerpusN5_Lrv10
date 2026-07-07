@extends('tampilan.app')
@section('title', 'Edit Member')

@section('content')
<section class="content">

    <div class="container-fluid">

        @include('tampilan.alert')

        <div class="card card-default">

            <div class="card-header">

                <h3 class="card-title">Halaman Edit Member</h3>

                <div class="card-tools">

                    <button type="button"
                            class="btn btn-tool"
                            data-card-widget="collapse">

                        <i class="fas fa-minus"></i>

                    </button>

                    <button type="button"
                            class="btn btn-tool"
                            data-card-widget="remove">

                        <i class="fas fa-times"></i>

                    </button>

                </div>

            </div>

            <form action="{{ route('member.update', $member->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Nama Lengkap</label>

                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       value="{{ old('name', $member->name) }}"
                                       placeholder="Masukkan Nama Lengkap">

                            </div>

                            <div class="form-group">

                                <label>Kelas</label>

                                <select class="form-control select2bs4"
                                        name="kelas_id"
                                        style="width:100%;">

                                    <option value="">-- Pilih Kelas --</option>

                                    @foreach($kelas as $k)

                                        <option value="{{ $k->id }}"
                                            {{ old('kelas_id', $member->kelas_id) == $k->id ? 'selected' : '' }}>

                                            {{ $k->nama_kelas }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <label>Alamat Email</label>

                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email', $member->email) }}"
                                       placeholder="Masukkan Email">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>No WhatsApp</label>

                                <input type="text"
                                       class="form-control"
                                       name="no_wa"
                                       value="{{ old('no_wa', $member->no_wa) }}"
                                       placeholder="Masukkan Nomor WhatsApp">

                            </div>

                            <div class="form-group">

                                <label>Password</label>

                                <input type="password"
                                       class="form-control"
                                       name="password"
                                       placeholder="Kosongkan jika tidak ingin diubah">

                                <small class="text-muted">

                                    Biarkan kosong apabila password tidak ingin diubah.

                                </small>

                            </div>

                            <div class="form-group">

                                <label>Alamat</label>

                                <textarea class="form-control"
                                          name="alamat"
                                          rows="3"
                                          placeholder="Masukkan Alamat">{{ old('alamat', $member->alamat) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit"
                            class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Update

                    </button>

                    <a href="{{ route('member.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</section>
@endsection

@section('javascript')

<script>

$(function () {

    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

});

</script>

@endsection