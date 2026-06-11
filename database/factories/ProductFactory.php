<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => $this->faker->words(3, true),
            'sku'         => strtoupper($this->faker->unique()->bothify('??-###')),
            'description' => $this->faker->sentence(),
            'price'       => $this->faker->randomFloat(2, 100, 50000),
            'unit'        => $this->faker->randomElement(['шт', 'кг', 'л']),
            'category_id' => Category::factory(),
            'image'       => null,
        ];
    }
}