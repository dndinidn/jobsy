<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'nama' => 'Andi Pencari',
                'email' => 'andi@example.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'pencari_kerja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'PT Maju Jaya',
                'email' => 'majujaya@example.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'CV Kreatif Solusi',
                'email' => 'kreatif@example.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
