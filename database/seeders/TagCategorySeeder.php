<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\TagCategory;
use Illuminate\Database\Seeder;

class TagCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagCategory::factory(5)->create()->each(function ($category) {
            Tag::factory(2)->create([
                'tag_category_id' => $category->id,
            ]);
        });
    }
}
