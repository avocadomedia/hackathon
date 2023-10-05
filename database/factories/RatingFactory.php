<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->streetAddress,
            'zip' => $this->faker->postcode,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
            'score' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text,
        ];
    }
}
