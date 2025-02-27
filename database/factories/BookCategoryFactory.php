<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['expense', 'income']),
            'description' => $this->faker->sentence,
        ];
    }
}