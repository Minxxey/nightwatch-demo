<?php

namespace Database\Seeders;

use App\Models\Candybar;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandybarTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all tag IDs as a collection
        $tagIds = Tag::query()->pluck('id');

// Assign random tags to each candybar
        foreach (Candybar::all() as $candybar) {
            $candybar->tags()->syncWithoutDetaching(
                $tagIds->shuffle()->take(rand(1, 5))
            );
        }
    }
}
