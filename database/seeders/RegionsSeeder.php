<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
      
    public function run()
    {
        $regions = [
            // Sulawesi Barat
            ['name' => 'Kabupaten Majene'],
            ['name' => 'Kabupaten Mamasa'],
            ['name' => 'Kabupaten Mamuju'],
            ['name' => 'Kabupaten Pasangkayu'],
            ['name' => 'Kabupaten Polewali Mandar'],
            ['name' => 'Kota Mamuju'],

            // Sulawesi Selatan
            ['name' => 'Kabupaten Barru'],
            ['name' => 'Kabupaten Bone'],
            ['name' => 'Kabupaten Bulukumba'],
            ['name' => 'Kabupaten Enrekang'],
            ['name' => 'Kabupaten Gowa'],
            ['name' => 'Kabupaten Jeneponto'],
            ['name' => 'Kabupaten Kepulauan Selayar'],
            ['name' => 'Kabupaten Luwu'],
            ['name' => 'Kabupaten Luwu Timur'],
            ['name' => 'Kabupaten Luwu Utara'],
            ['name' => 'Kabupaten Maros'],
            ['name' => 'Kabupaten Pangkajene dan Kepulauan'],
            ['name' => 'Kabupaten Pinrang'],
            ['name' => 'Kabupaten Sidenreng Rappang'],
            ['name' => 'Kabupaten Sinjai'],
            ['name' => 'Kabupaten Soppeng'],
            ['name' => 'Kabupaten Takalar'],
            ['name' => 'Kabupaten Tana Toraja'],
            ['name' => 'Kabupaten Toraja Utara'],
            ['name' => 'Kabupaten Wajo'],
            ['name' => 'Kota Makassar'],
            ['name' => 'Kota Parepare'],
            ['name' => 'Kota Palopo'],

            // Jawa Barat
            ['name' => 'Kabupaten Bandung'],
            ['name' => 'Kabupaten Bandung Barat'],
            ['name' => 'Kabupaten Bekasi'],
            ['name' => 'Kabupaten Bogor'],
            ['name' => 'Kabupaten Ciamis'],
            ['name' => 'Kabupaten Cianjur'],
            ['name' => 'Kabupaten Cirebon'],
            ['name' => 'Kabupaten Garut'],
            ['name' => 'Kabupaten Indramayu'],
            ['name' => 'Kabupaten Karawang'],
            ['name' => 'Kabupaten Kuningan'],
            ['name' => 'Kabupaten Majalengka'],
            ['name' => 'Kabupaten Pangandaran'],
            ['name' => 'Kabupaten Purwakarta'],
            ['name' => 'Kabupaten Subang'],
            ['name' => 'Kabupaten Sukabumi'],
            ['name' => 'Kabupaten Sumedang'],
            ['name' => 'Kabupaten Tasikmalaya'],
            ['name' => 'Kota Bandung'],
            ['name' => 'Kota Banjar'],
            ['name' => 'Kota Bekasi'],
            ['name' => 'Kota Bogor'],
            ['name' => 'Kota Cimahi'],
            ['name' => 'Kota Cirebon'],
            ['name' => 'Kota Depok'],
            ['name' => 'Kota Sukabumi'],
            ['name' => 'Kota Tasikmalaya'],

            // DKI Jakarta
            ['name' => 'Kota Administrasi Jakarta Pusat'],
            ['name' => 'Kota Administrasi Jakarta Utara'],
            ['name' => 'Kota Administrasi Jakarta Barat'],
            ['name' => 'Kota Administrasi Jakarta Selatan'],
            ['name' => 'Kota Administrasi Jakarta Timur'],
            ['name' => 'Kepulauan Seribu'],
        ];

    DB::table('regions')->insert($regions);
    }
}


