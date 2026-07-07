<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; // Memanggil package Storage

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Bersihkan folder 'buku' dari penyimpanan public sebelum memasukkan data baru
        if (Storage::disk('public')->exists('buku')) {
            Storage::disk('public')->deleteDirectory('buku');
        }
        
        // Buat ulang direktori 'buku' kosong agar siap menampung file baru
        Storage::disk('public')->makeDirectory('buku');

        // 2. Jalankan semua seeder bawaan Anda
        $this->call([
            JurusanSeeder::class,
            KelasSeeder::class,
            KategoriSeeder::class,
            RakSeeder::class,
            UserSeeder::class,
            BukuSeeder::class,
        ]);
    }
}
