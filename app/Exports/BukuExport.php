<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BukuExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles
{
    public function collection()
    {
        return Buku::with(['kategori', 'rak'])
            ->get()
            ->map(function ($buku) {

                return [
                    $buku->kode_buku,
                    $buku->judul,
                    $buku->pengarang,
                    $buku->penerbit,
                    $buku->tahun_terbit,
                    $buku->kategori->nama_kategori ?? '-',
                    $buku->rak->nama_rak ?? '-',
                    $buku->stok,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Kode Buku',
            'Judul',
            'Pengarang',
            'Penerbit',
            'Tahun Terbit',
            'Kategori',
            'Rak',
            'Stok',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [

            // HEADER
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
            ],
        ];
    }
}