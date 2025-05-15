<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KategoriPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
    DB::table('kategori_pekerjaan')->insert([
        ['nama' => 'IT'],
        ['nama' => 'Keuangan'],
        ['nama' => 'Pendidikan'],
    ]);
}

    }
