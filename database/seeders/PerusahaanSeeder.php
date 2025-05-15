<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perusahaan')->insert([
            [
                'pengguna_id' => 2, // Mengacu pada id pengguna yang sudah ada, misalnya pengguna dengan id 2
                'nama_perusahaan' => 'PT Maju Jaya',
                'logo' => 'path/to/logo1.jpg',
                'deskripsi' => 'Perusahaan bergerak di bidang konstruksi dan pengembangan properti.',
                'alamat' => 'Jl. Maju No. 123, Jakarta, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pengguna_id' => 3, // Mengacu pada id pengguna yang sudah ada, misalnya pengguna dengan id 3
                'nama_perusahaan' => 'CV Kreatif Solusi',
                'logo' => 'path/to/logo2.jpg',
                'deskripsi' => 'Perusahaan yang bergerak di bidang IT dan pengembangan perangkat lunak.',
                'alamat' => 'Jl. Kreatif No. 45, Bandung, Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
