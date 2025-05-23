<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candybar>
 */
class CandybarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'amount' => $this->faker->randomDigitNotZero(),
            'candybarTreshhold' => $this->faker->randomDigitNotZero(),
            'isAvailable' => $this->faker->boolean(70),
        ];
    }
}
