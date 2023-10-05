<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        Rating::factory()->createMany([
            [
                'pdok_id' => 'adr-05d9f079a1e8e66f30122d9ca3b0acd3',
                'score' => rand(1, 5),
                'comment' => fake()->paragraph,
            ],
            [
                'pdok_id' => 'adr-59be0fb2a8a0e4d47bca7156018d76b6',
                'score' => rand(1, 5),
                'comment' => fake()->paragraph,
            ],
            [
                'pdok_id' => 'adr-1e4178e2a4a243de2e669af9213b3785',
                'score' => rand(1, 5),
                'comment' => fake()->paragraph,
            ],
        ]);
    }
}
