<?php

namespace App\Exports;

use App\Models\Pinjam;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanPeminjamanExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return Collection::make($this->data)->map(function ($item) {

            return [

                'ID Register' => $item->user->id_register ?? '-',
                'Nama Member' => $item->user->name ?? '-',
                'Judul Buku' => $item->buku->judul ?? '-',
                'Tanggal Pinjam' => $item->tanggal_pinjam,
                'Tanggal Kembali' => $item->tanggal_kembali,
                'Status' => $item->status,
                'Denda' => $item->denda,

            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Register',
            'Nama Member',
            'Judul Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'Denda',
        ];
    }
}