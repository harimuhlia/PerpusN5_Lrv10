<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">

<style>

    @page{
        size: A4;
        margin: 20mm;
    }

    body{
        font-family: Arial, sans-serif;
        background: #f5f5f5;
    }

    .wrapper{
        width: 100%;
        text-align: center;
        margin-top: 40px;
    }

    .kartu{
        width: 360px;
        height: 220px;
        border: 2px solid #2563eb;
        border-radius: 16px;
        padding: 18px;
        position: relative;
        background: #fff;
        box-sizing: border-box;
        overflow: hidden;
        display: inline-block;
        text-align: left;
    }

    /* HEADER BIRU */
    .kartu::before{
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 60px;
        background: #2563eb;
        border-radius: 14px 14px 0 0;
    }

    .header{
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        margin-top: -5px;
        margin-bottom: 25px;
    }

    .title{
        font-size: 16px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .subtitle{
        font-size: 11px;
        margin-top: 3px;
    }

    .content{
        width: 100%;
        display: table;
    }

    .foto-section{
        width: 90px;
        display: table-cell;
        vertical-align: top;
    }

    .foto{
        width: 75px;
        height: 90px;
        border: 1px solid #999;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
    }

    .foto img{
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .info{
        display: table-cell;
        vertical-align: top;
        padding-left: 10px;
        font-size: 13px;
    }

    .info p{
        margin: 0 0 8px;
        line-height: 1.4;
    }

    .label{
        font-weight: bold;
        display: inline-block;
        width: 55px;
    }

    .footer{
        position: absolute;
        bottom: 10px;
        left: 18px;
        right: 18px;
        text-align: center;
        font-size: 10px;
        color: #666;
        border-top: 1px solid #ddd;
        padding-top: 6px;
    }

</style>

</head>
<body>

<div class="wrapper">

    <div class="kartu">

        {{-- HEADER --}}
        <div class="header">

            <div class="title">
                KARTU ANGGOTA PERPUSTAKAAN
            </div>

            <div class="subtitle">
                SMK NEGERI 5 KABUPATEN TANGERANG
            </div>

        </div>

        {{-- CONTENT --}}
        <div class="content">

            {{-- FOTO / LOGO --}}
            <div class="foto-section">

                <div class="foto">

                    <img src="{{ public_path('storage/logo/logon5.png') }}">

                </div>

            </div>

            {{-- DATA --}}
            <div class="info">

                <p>
                    <span class="label">ID</span>
                    : {{ $member->id_register }}
                </p>

                <p>
                    <span class="label">Nama</span>
                    : {{ $member->name }}
                </p>

                <p>
                    <span class="label">Kelas</span>
                    : {{ $member->kelas->nama_kelas ?? '-' }}
                </p>

                <p>
                    <span class="label">WA</span>
                    : {{ $member->no_wa }}
                </p>

                <p>
                    <span class="label">Email</span>
                    : {{ $member->email }}
                </p>

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="footer">
            Berlaku selama menjadi anggota perpustakaan
        </div>

    </div>

</div>

</body>
</html>