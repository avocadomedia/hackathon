<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pdok_id' => $this->faker->uuid,
            'score' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text,
        ];
    }
}
