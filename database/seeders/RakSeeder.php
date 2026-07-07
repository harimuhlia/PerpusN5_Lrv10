<?php

namespace Database\Seeders;

use App\Models\Rak;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rak::create([
            'kode_rak' => 'RAK001',
            'nama_rak' => 'Rak A',
            'keterangan' => 'Rak Buku Pemrograman',
        ]);

        Rak::create([
            'kode_rak' => 'RAK002',
            'nama_rak' => 'Rak B',
            'keterangan' => 'Rak Buku Jaringan',
        ]);

        Rak::create([
            'kode_rak' => 'RAK003',
            'nama_rak' => 'Rak C',
            'keterangan' => 'Rak Buku Database',
        ]);
    }
}
