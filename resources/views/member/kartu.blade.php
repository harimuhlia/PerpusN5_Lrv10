<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>Kartu Member</title>

    <style>

        @media print{
            @page{
                size: A4 portrait;
                margin: 10mm;
            }

            body{
                margin: 0;
            }
        }

        body{
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 20px;
        }

        .judul{
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2563eb;
        }

        .subjudul{
            text-align: center;
            font-size: 13px;
            margin-bottom: 25px;
            color: #555;
        }

        /* TOMBOL PRINT */
        .print-box{
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-print{
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-print:hover{
            background: #1d4ed8;
        }

        /* CONTAINER */
        .container{
            width: 100%;
            display: flex;
            justify-content: center;
        }

        /* CARD */
        .card{
            width: 48%;
            border: 2px solid #000;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
            font-size: 12px;
            min-height: 155px;
            box-sizing: border-box;
        }

        /* HEADER */
        .header{
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 8px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            color: #2563eb;
        }

        /* TABLE */
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
            text-align: left;
            vertical-align: top;
            padding-top: 8px;
        }

        .row{
            font-size: 11px;
            margin-bottom: 5px;
            line-height: 1.5;
            word-break: break-word;
        }

        .label{
            font-weight: bold;
        }

        /* FOTO */
        .photo-box{
            width: 90px;
            height: 95px;

            margin-left: -8px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .photo-box img{
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* FOOTER */
        .footer{
            margin-top: 8px;
            font-size: 10px;
            text-align: center;
            line-height: 1.4;
            border-top: 1px dashed #ccc;
            padding-top: 5px;
            color: #555;
        }

        /* HILANGKAN TOMBOL SAAT PRINT */
        @media print{
            .print-box{
                display: none;
            }

            body{
                background: white;
                padding: 0;
            }
        }

    </style>

</head>

<body>

    {{-- BUTTON PRINT --}}
    <div class="print-box">

        <button onclick="window.print()" class="btn-print">
            Print / Save PDF
        </button>

    </div>

    {{-- JUDUL --}}
    <div class="judul">
        KARTU MEMBER PERPUSTAKAAN
    </div>

    <div class="subjudul">
        Data Kartu Anggota Perpustakaan Sekolah
    </div>

    {{-- CONTAINER --}}
    <div class="container">

        <div class="card">

            {{-- HEADER --}}
            <div class="header">
                KARTU MEMBER
            </div>

            {{-- CONTENT --}}
            <table>

                <tr>

                    {{-- DATA --}}
                    <td class="data">

                        <div class="row">
                            <span class="label">ID :</span>
                            {{ $member->id_register }}
                        </div>

                        <div class="row">
                            <span class="label">Nama :</span>
                            {{ $member->name }}
                        </div>

                        <div class="row">
                            <span class="label">Kelas :</span>
                            {{ $member->kelas->nama_kelas ?? '-' }}
                        </div>

                        <div class="row">
                            <span class="label">WA :</span>
                            {{ $member->no_wa }}
                        </div>

                        <div class="row">
                            <span class="label">Email :</span>
                            {{ $member->email }}
                        </div>

                    </td>

                    {{-- FOTO --}}
                    <td class="foto">

                        <div class="photo-box">

                            @if($member->photo)

                                <img src="{{ asset('storage/'.$member->photo) }}">

                            @else

                                <img src="{{ asset('storage/logo/logon5.png') }}">

                            @endif

                        </div>

                    </td>

                </tr>

            </table>

            {{-- FOOTER --}}
            <div class="footer">

                Perpustakaan Sekolah
                <br>
                Berlaku selama menjadi anggota

            </div>

        </div>

    </div>

</body>

</html>
