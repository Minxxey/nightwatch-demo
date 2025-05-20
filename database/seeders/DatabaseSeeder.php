<?php

namespace Database\Seeders;

use App\Models\Candybar;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TagSeeder::class,
            CandybarSeeder::class,
            CandybarTagSeeder::class,
        ]);
    }
}
