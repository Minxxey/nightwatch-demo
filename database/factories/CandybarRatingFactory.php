<?php

namespace Database\Factories;

use App\Models\Candybar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CandybarRating>
 */
class CandybarRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'candybar_id' => Candybar::factory(),
            'user_id' => User::inRandomOrder()->first()->id,
            'score' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->boolean(70) ? $this->faker->sentence() : null,
        ];
    }
}
