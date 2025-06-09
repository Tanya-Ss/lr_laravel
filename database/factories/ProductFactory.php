<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 100, 5000),
            'stock' => $this->faker->numberBetween(0, 100),
            'images' => json_encode([
                'https://via.placeholder.com/400?text=Dish+' . $this->faker->numberBetween(1, 100),
                'https://via.placeholder.com/400?text=Dish+' . $this->faker->numberBetween(1, 100)
            ])
        ];
    }
}