<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'total' => $this->faker->randomFloat(2, 1000, 20000),
            'status' => $this->faker->randomElement(['new', 'processing', 'shipped', 'completed']),
            'notes' => $this->faker->optional()->sentence
        ];
    }
}