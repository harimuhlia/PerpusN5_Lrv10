<?php

namespace App\Exports;

use App\Models\PembayaranDenda;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PembayaranDendaExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $tanggalAwal;
    protected $tanggalAkhir;

    public function __construct($tanggalAwal = null, $tanggalAkhir = null)
    {
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    public function collection()
    {
        $query = PembayaranDenda::with([
            'pinjam.user.kelas',
            'pinjam.buku',
            'petugas'
        ]);

        if ($this->tanggalAwal && $this->tanggalAkhir) {
            $query->whereBetween('tanggal_bayar', [
                $this->tanggalAwal,
                $this->tanggalAkhir
            ]);
        }

        $data = $query->orderBy('tanggal_bayar')->get();

        $no = 1;

        return new Collection(

            $data->map(function ($item) use (&$no) {

                return [
                    'No' => $no++,
                    'Tanggal Bayar' => $item->tanggal_bayar,
                    'Nama Peminjam' => $item->pinjam->user->name,
                    'ID Register' => $item->pinjam->user->id_register ?? '-',
                    'Kelas' => $item->pinjam->user->kelas->nama_kelas ?? '-',
                    'Judul Buku' => $item->pinjam->buku->judul,
                    'Metode Pembayaran' => $item->metode_pembayaran,
                    'Petugas' => $item->petugas->name ?? '-',
                    'Nominal' => $item->nominal,
                    'Keterangan' => $item->keterangan,
                ];

            })

        );
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal Bayar',
            'Nama Peminjam',
            'ID Register',
            'Kelas',
            'Judul Buku',
            'Metode Pembayaran',
            'Petugas',
            'Nominal',
            'Keterangan'
        ];
    }
}