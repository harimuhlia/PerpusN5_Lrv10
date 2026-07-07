<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::create([
            'kode_buku' => 'BK001',
            'judul' => 'Pemrograman Laravel 10',
            'pengarang' => 'Hari Muhlia',
            'penerbit' => 'Informatika',
            'tahun_terbit' => 2025,
            'stok' => 50,
            'kategori_id' => 1,
            'rak_id' => 1,
        ]);

        Buku::create([
            'kode_buku' => 'BK002',
            'judul' => 'Dasar HTML dan CSS',
            'pengarang' => 'Andi Setiawan',
            'penerbit' => 'Erlangga',
            'tahun_terbit' => 2024,
            'stok' => 40,
            'kategori_id' => 1,
            'rak_id' => 1,
        ]);

        Buku::create([
            'kode_buku' => 'BK003',
            'judul' => 'Belajar JavaScript',
            'pengarang' => 'Budi Santoso',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2023,
            'stok' => 35,
            'kategori_id' => 1,
            'rak_id' => 1,
        ]);

        Buku::create([
            'kode_buku' => 'BK004',
            'judul' => 'Jaringan Komputer',
            'pengarang' => 'Rizky Pratama',
            'penerbit' => 'Informatika',
            'tahun_terbit' => 2022,
            'stok' => 25,
            'kategori_id' => 1,
            'rak_id' => 1,
        ]);
    }
}
