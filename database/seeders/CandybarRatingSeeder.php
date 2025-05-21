<?php

namespace Database\Seeders;

use App\Models\Candybar;
use App\Models\CandybarRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandybarRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candybar::all()->each(function ($candybar) {
            CandybarRating::factory(rand(3, 10))->create([
                'candybar_id' => $candybar->id,
            ]);
        });
    }
}
