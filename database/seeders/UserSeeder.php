<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory([
            'email' => 'admin@byte5.de',
        ])->create();
        User::factory([
            'email' => 'candybarmaster@byte5.de',
        ])->create();
        User::factory()->create();
    }
}
