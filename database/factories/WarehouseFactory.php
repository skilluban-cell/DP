<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'    => $this->faker->company() . ' склад',
            'address' => $this->faker->address(),
        ];
    }
}