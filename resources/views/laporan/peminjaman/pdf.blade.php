<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>
        Laporan Peminjaman
    </title>

    <style>

        @page {
            size: A4 landscape;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 2px;
        }

        .line {
            border-top: 3px solid #000;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 11px;
        }

        table th {
            background: #f2f2f2;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .signature {
            width: 250px;
            float: right;
            text-align: center;
        }

    </style>

</head>

<body>

    {{-- HEADER --}}
    <div class="header">

        <h2>
            PERPUSTAKAAN DIGITAL SEKOLAH
        </h2>

        <h3>
            SMK NEGERI CONTOH
        </h3>

        <p>
            Jl. Pendidikan No. 1
        </p>

    </div>

    <div class="line"></div>

    {{-- INFO --}}
    <div class="info">

        <table width="100%" border="0">

            <tr>

                <td width="50%">
                    <b>Laporan :</b> Data Peminjaman Buku
                </td>

                <td width="50%" align="right">
                    <b>Tanggal Cetak :</b>
                    {{ date('d-m-Y H:i') }}
                </td>

            </tr>

            <tr>

                <td>
                    <b>Total Data :</b>
                    {{ $laporan->count() }}
                </td>

                <td></td>

            </tr>

        </table>

    </div>

    {{-- TABLE --}}
    <table>

        <thead>

            <tr>

                <th width="4%">
                    No
                </th>

                <th>
                    ID Register
                </th>

                <th>
                    Nama Member
                </th>

                <th>
                    Judul Buku
                </th>

                <th>
                    Tanggal Pinjam
                </th>

                <th>
                    Tanggal Kembali
                </th>

                <th>
                    Status
                </th>

                <th>
                    Denda
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($laporan as $item)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->user->id_register ?? '-' }}
                    </td>

                    <td>
                        {{ $item->user->name ?? '-' }}
                    </td>

                    <td>
                        {{ $item->buku->judul ?? '-' }}
                    </td>

                    <td class="text-center">
                        {{ $item->tanggal_pinjam }}
                    </td>

                    <td class="text-center">
                        {{ $item->tanggal_kembali }}
                    </td>

                    <td class="text-center">
                        {{ ucfirst($item->status) }}
                    </td>

                    <td class="text-center">

                        Rp {{ number_format($item->denda, 0, ',', '.') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="text-center">
                        Data kosong
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    {{-- FOOTER --}}
    <div class="footer">

        <div class="signature">

            <p>
                Mengetahui,
            </p>

            <br><br><br>

            <p>
                ______________________
            </p>

            <p>
                Kepala Perpustakaan
            </p>

        </div>

    </div>

</body>

</html>