<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition()
    {
        return [
            'author_name' => $this->faker->name,
            'content' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 5)
        ];
    }
}