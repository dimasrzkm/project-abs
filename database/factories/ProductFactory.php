<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = Categorie::all()->pluck('id');

        return [
            'categorie_id' => fake()->randomElement($categories),
            'name_product' => fake()->word(),
            'price' => fake()->randomFloat(2, 5000, 500000),
            'stock' => fake()->randomDigit(),
        ];
    }
}
