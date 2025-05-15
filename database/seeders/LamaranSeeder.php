<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LamaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('lamaran')->insert([
            [
                'lowongan_id' => 1, // ID lowongan yang sesuai
                'pencari_kerja_id' => 1, // ID pencari kerja yang sesuai
              
                'status' => 'Menunggu', // Status lamaran
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }
}
