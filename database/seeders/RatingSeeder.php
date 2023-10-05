<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        Rating::factory()->create([
            'pdok_id' => 'adr-1e4178e2a4a243de2e669af9213b3785',
            'pdok_latitude' => 4.94183893,
            'pdok_longitude' => 52.34843464,
            'score' => rand(1, 5),
            'comment' => fake()->paragraph,
        ]);
    }
}
