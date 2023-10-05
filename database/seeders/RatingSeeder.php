<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        Rating::factory()->create([
            'pdok_id' => 'adr-05d9f079a1e8e66f30122d9ca3b0acd3',
            'pdok_latitude' => 4.94183893,
            'pdok_longitude' => 52.34843464,
            'score' => rand(1, 5),
            'comment' => fake()->paragraph,
        ]);
    }
}
