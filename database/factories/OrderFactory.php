<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all()->pluck('id');

        return [
            'user_id' => fake()->randomElement($users),
            'status' => fake()->randomElement(['waiting', 'deliver']),
            'total' => fake()->randomFloat(2, 8000, 500000),
            'date_order' => fake()->date(),
        ];
    }
}
