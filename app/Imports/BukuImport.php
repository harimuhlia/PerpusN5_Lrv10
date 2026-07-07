<?php

namespace App\Imports;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BukuImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (Buku::where('kode_buku', $row['kode_buku'])->exists()) {
            return null;
        }

        $kategori = Kategori::firstOrCreate([
            'nama_kategori' => $row['kategori']
        ]);

        $rak = Rak::firstOrCreate([
            'nama_rak' => $row['rak']
        ]);

        return new Buku([
            'kode_buku' => $row['kode_buku'],
            'judul' => $row['judul'],
            'pengarang' => $row['pengarang'],
            'penerbit' => $row['penerbit'],
            'tahun_terbit' => $row['tahun_terbit'],
            'stok' => $row['stok'],
            'kategori_id' => $kategori->id,
            'rak_id' => $rak->id,
        ]);
    }
}