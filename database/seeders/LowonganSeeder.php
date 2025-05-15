<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        
    DB::table('lowongan')->insert([
        [
            'judul' => 'Software Engineer',
            'deskripsi' => 'Membangun aplikasi dan sistem backend.',
            'gaji' => 10000000,
            'gambar' => 'path/to/job_image1.jpg',
            'kategori_id' => 1,
            'lokasi_id' => 1,
            'pengguna_id' => 1,
            'perusahaan_id' => 1, // Pastikan perusahaan_id ada
            'persyaratan' => 'Pengalaman 2 tahun di bidang IT.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'judul' => 'Backend Developer',
            'deskripsi' => 'Membuat dan mengelola API.',
            'gaji' => 12000000,
            'gambar' => 'path/to/job_image2.jpg',
            'kategori_id' => 1,
            'lokasi_id' => 2,
            'pengguna_id' => 2,
            'perusahaan_id' => 2, // Pastikan perusahaan_id ada
            'persyaratan' => 'Pengalaman 3 tahun di bidang pengembangan perangkat lunak.',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}

    }

