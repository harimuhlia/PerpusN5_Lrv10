@extends('tampilan.app')
@section('title','Kontak')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-address-book mr-2"></i>
                            Hubungi Kami
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Silakan menghubungi petugas sesuai kebutuhan Anda. Klik tombol
                            <strong>WhatsApp</strong> untuk langsung menghubungi petugas.
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card card-primary card-outline shadow-sm">
                                    <div class="card-body box-profile text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="https://ui-avatars.com/api/?name=Admin+Perpustakaan&background=007bff&color=fff"
                                            alt="Admin Perpustakaan">

                                        <h3 class="profile-username mt-2">
                                            Admin Perpustakaan
                                        </h3>

                                        <p class="text-muted">
                                            Pelayanan Peminjaman & Pengembalian
                                        </p>

                                        <ul class="list-group list-group-unbordered mb-3 text-left">
                                            <li class="list-group-item">
                                                <b><i class="fas fa-phone text-success"></i> WhatsApp</b>
                                                <span class="float-right">08xxxxxxxxxx</span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-clock text-warning"></i> Jam Layanan</b>
                                                <span class="float-right">08.00 - 15.00</span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-calendar text-primary"></i> Hari</b>
                                                <span class="float-right">Senin - Jumat</span>
                                            </li>
                                        </ul>

                                        <a href="https://wa.me/628xxxxxxxxxx"
                                            target="_blank"
                                            class="btn btn-success btn-block">
                                            <i class="fab fa-whatsapp"></i>
                                            Hubungi WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card card-success card-outline shadow-sm">
                                    <div class="card-body box-profile text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="https://ui-avatars.com/api/?name=Penjaga+Perpustakaan&background=28a745&color=fff"
                                            alt="Penjaga Perpustakaan">

                                        <h3 class="profile-username mt-2">
                                            Penjaga Perpustakaan
                                        </h3>

                                        <p class="text-muted">
                                            Informasi Koleksi & Pelayanan
                                        </p>

                                        <ul class="list-group list-group-unbordered mb-3 text-left">
                                            <li class="list-group-item">
                                                <b><i class="fas fa-phone text-success"></i> WhatsApp</b>
                                                <span class="float-right">08xxxxxxxxxx</span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-clock text-warning"></i> Jam Layanan</b>
                                                <span class="float-right">07.30 - 16.00</span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-calendar text-primary"></i> Hari</b>
                                                <span class="float-right">Senin - Jumat</span>
                                            </li>
                                        </ul>

                                        <a href="https://wa.me/628xxxxxxxxxx"
                                            target="_blank"
                                            class="btn btn-success btn-block">
                                            <i class="fab fa-whatsapp"></i>
                                            Hubungi WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-12">
                                <div class="card card-dark card-outline shadow-sm">
                                    <div class="card-body box-profile text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="https://ui-avatars.com/api/?name=Hari+Muhlia&background=343a40&color=fff"
                                            alt="Developer">

                                        <h3 class="profile-username mt-2">
                                            Admin WebDev App
                                        </h3>

                                        <p class="text-muted">
                                            Pengembang & Maintenance Sistem
                                        </p>

                                        <ul class="list-group list-group-unbordered mb-3 text-left">
                                            <li class="list-group-item">
                                                <b><i class="fas fa-user text-primary"></i> Developer</b>
                                                <span class="float-right">Hari Muhlia</span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-phone text-success"></i> WhatsApp</b>
                                                <span class="float-right">08xxxxxxxxxx</span>
                                            </li>
                                            <li class="list-group-item">
                                                <b><i class="fas fa-laptop-code text-dark"></i> Support</b>
                                                <span class="float-right">Laravel 10</span>
                                            </li>
                                        </ul>

                                        <a href="https://wa.me/628xxxxxxxxxx"
                                            target="_blank"
                                            class="btn btn-success btn-block">
                                            <i class="fab fa-whatsapp"></i>
                                            Hubungi Developer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>
@endsection

@section('css')
<style>
    .card {
        border-radius: 10px;
        transition: .3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .profile-user-img {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border: 4px solid #dee2e6;
        padding: 3px;
    }

    .list-group-item {
        font-size: 14px;
    }

    .btn-block {
        border-radius: 30px;
        font-weight: 600;
    }

    .card-title {
        font-weight: 600;
    }

    .alert {
        border-radius: 8px;
    }

    @media (max-width:768px) {
        .profile-user-img {
            width: 90px;
            height: 90px;
        }

        .profile-username {
            font-size: 20px;
        }
    }
</style>
@endsection