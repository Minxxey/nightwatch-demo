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
            'name' => $this->faker->randomElement(['Snickers', 'Mars', 'Twix', 'Bounty', 'Milky Way', 'Lion', 'KitKat', 'Toffee Crisp', 'Crunch', 'Baby Ruth', 'Butterfinger', 'Almond Joy', '3 Musketeers', 'Reese\'s', 'York']),
            'amount' => $this->faker->randomDigitNotZero(),
            'candybarTreshhold' => $this->faker->randomDigitNotZero(),
            'isAvailable' => $this->faker->boolean(70)
        ];
    }
}
