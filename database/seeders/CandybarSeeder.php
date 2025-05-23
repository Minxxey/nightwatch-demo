<?php

namespace Database\Seeders;

use App\Models\Candybar;
use Illuminate\Database\Seeder;

class CandybarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candybar::factory()->count(350)->create();
    }
}
