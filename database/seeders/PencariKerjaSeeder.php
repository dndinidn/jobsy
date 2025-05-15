<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PencariKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('pencari_kerja')->insert([
            [
                'pengguna_id' => 1, // ID pengguna yang sudah ada di tabel pengguna
                'cv' => 'cv_andi.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pengguna_id' => 2, // ID pengguna yang sudah ada di tabel pengguna
                'cv' => 'cv_budi.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
