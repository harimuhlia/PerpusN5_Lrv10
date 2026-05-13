<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Member Masal</title>

    <style>

        @page{
            size: A4;
            margin: 10mm;
        }

        body{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .judul{
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subjudul{
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }

        /* 2 KOLOM */
        .container{
            width: 100%;
            font-size: 0;
        }

        .card{
            width: 48%;
            border: 1px solid #000;
            border-radius: 10px;
            padding: 8px;
            margin-bottom: 10px;
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
            page-break-inside: avoid;
            font-size: 12px;
            min-height: 150px;
        }

        /* kasih jarak antar kolom */
        .card:nth-child(odd){
            margin-right: 4%;
        }

        .header{
            text-align: center;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        .data{
            width: 75%;
            vertical-align: top;
        }

        .foto{
            width: 25%;
            text-align: center;
            vertical-align: top;
        }

        .row{
            font-size: 11px;
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .label{
            font-weight: bold;
        }

        .photo-box{
            width: 60px;
            height: 75px;
            border: 1px solid #000;
            border-radius: 4px;
            margin: auto;
            overflow: hidden;
        }

        .photo-box img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .footer{
            margin-top: 8px;
            font-size: 10px;
            text-align: center;
            line-height: 1.3;
        }

    </style>

</head>
<body>

    <div class="judul">
        KARTU MEMBER PERPUSTAKAAN
    </div>

    <div class="subjudul">
        Data Kartu Anggota Perpustakaan Sekolah
    </div>

    <div class="container">

        @foreach($member as $item)

            <div class="card">

                <div class="header">
                    KARTU MEMBER
                </div>

                <table>
                    <tr>

                        <td class="data">

                            <div class="row">
                                <span class="label">ID :</span>
                                {{ $item->id_register }}
                            </div>

                            <div class="row">
                                <span class="label">Nama :</span>
                                {{ $item->name }}
                            </div>

                            <div class="row">
                                <span class="label">Kelas :</span>
                                {{ $item->kelas->nama_kelas ?? '-' }}
                            </div>

                            <div class="row">
                                <span class="label">WA :</span>
                                {{ $item->no_wa }}
                            </div>

                            <div class="row">
                                <span class="label">Email :</span>
                                {{ $item->email }}
                            </div>

                        </td>

                        <td class="foto">

                            <div class="photo-box">

                                @if($item->photo)
                                    {{-- <img src="{{ public_path('storage/'.$item->photo) }}"> --}}
                                    <img src="{{ public_path('storage/logo/logon5.png') }}">
                                @endif

                            </div>

                        </td>

                    </tr>
                </table>

                <div class="footer">
                    Perpustakaan Sekolah<br>
                    Berlaku selama menjadi anggota
                </div>

            </div>

        @endforeach

    </div>

</body>
</html>