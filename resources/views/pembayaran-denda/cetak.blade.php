<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pembayaran Denda</title>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            text-align: center;
            background: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-40 {
            margin-top: 40px;
        }
    </style>

</head>

<body>

    <table style="border:none;">
        <tr style="border:none;">
            <td style="border:none;width:90px;text-align:center;">
                {{-- Logo --}}
                {{-- <img src="{{ public_path('logo.png') }}" width="70"> --}}
            </td>
            <td style="border:none;text-align:center;">
                <h2 style="margin:0;">PERPUSTAKAAN</h2>
                <h3 style="margin:0;">SMK KABUPATEN TANGERANG</h3>
                <p style="margin:0;">
                    Laporan Pembayaran Denda Buku
                </p>

                @if($tanggalAwal && $tanggalAkhir)
                <p style="margin:0;">
                    Periode :
                    {{ \Carbon\Carbon::parse($tanggalAwal)->format('d-m-Y') }}
                    s/d
                    {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y') }}
                </p>
                @endif

            </td>
        </tr>
    </table>

    <hr>

    <table>

        <thead>

            <tr>
                <th width="40">No</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Buku</th>
                <th>Metode</th>
                <th>Petugas</th>
                <th>Nominal</th>
            </tr>

        </thead>

        <tbody>

            @foreach($pembayaran as $item)

            <tr>

                <td class="text-center">
                    {{ $loop->iteration }}
                </td>

                <td class="text-center">
                    {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d-m-Y') }}
                </td>

                <td>
                    {{ $item->pinjam->user->name }}
                </td>

                <td class="text-center">
                    {{ $item->pinjam->user->kelas->nama_kelas ?? '-' }}
                </td>

                <td>
                    {{ $item->pinjam->buku->judul }}
                </td>

                <td class="text-center">
                    {{ $item->metode_pembayaran }}
                </td>

                <td>
                    {{ $item->petugas->name ?? '-' }}
                </td>

                <td class="text-right">
                    Rp {{ number_format($item->nominal,0,',','.') }}
                </td>

            </tr>

            @endforeach

            <tr>

                <th colspan="7" class="text-right">
                    TOTAL
                </th>

                <th class="text-right">
                    Rp {{ number_format($totalNominal,0,',','.') }}
                </th>

            </tr>

        </tbody>

    </table>

    <table style="margin-top:40px;border:none;">

        <tr style="border:none;">

            <td style="border:none;width:60%;"></td>

            <td style="border:none;text-align:center;">

                Tangerang,
                {{ now()->translatedFormat('d F Y') }}

                <br><br><br><br>

                <b>Admin Perpustakaan</b>

            </td>

        </tr>

    </table>

</body>

</html>