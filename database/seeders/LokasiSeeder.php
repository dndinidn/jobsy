<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokasi')->insert([
            ['kota' => 'Jakarta', 'created_at' => now(), 'updated_at' => now()],
            ['kota' => 'Bandung', 'created_at' => now(), 'updated_at' => now()],
            ['kota' => 'Surabaya', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
