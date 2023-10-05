<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pdok_id' => $this->faker->uuid,
            'pdok_latitude' => 5.98765,
            'pdok_longitude' => 5.98765,
            'score' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text,
        ];
    }
}
