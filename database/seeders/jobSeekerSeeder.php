<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class jobSeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'user',
            'email' => 'user@contoh.com',
            'password' => Hash::make('1234567'),  // password default
            'role' => 'user',
        ]);
        //
    }
}
