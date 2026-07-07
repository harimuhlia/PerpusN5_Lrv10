<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'id_register' => 'ADM001',
            'no_wa' => '081234567890',
            'alamat' => 'Tangerang',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'kelas_id' => 1,
            'id_register' => 'MBR001',
            'no_wa' => '081111111111',
            'alamat' => 'Pasarkemis',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'kelas_id' => 1,
            'id_register' => 'MBR002',
            'no_wa' => '082222222222',
            'alamat' => 'Rajeg',
        ]);

        User::create([
            'name' => 'Rizky Pratama',
            'email' => 'rizky@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'anggota',
            'kelas_id' => 1,
            'id_register' => 'MBR003',
            'no_wa' => '083333333333',
            'alamat' => 'Cikupa',
        ]);
    }
}
