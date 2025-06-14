<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->paragraph
        ];
    }
}