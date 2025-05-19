<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class employerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'pt.satu',
            'email' => 'perusahaan@contoh.com',
            'password' => Hash::make('1234567'),  // password default
            'role' => 'perusahaan',
        ]);
        //
    }
}
