<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
        AdminSeeder::class,
        employerSeeder::class,
        jobSeekerSeeder::class,
        KategoriSeeder::class,
       
    ]);
        // Jika perlu membuat user lain (optional)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
