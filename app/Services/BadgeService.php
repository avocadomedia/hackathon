<?php

namespace App\Services;

use App\Models\Rating;

class BadgeService
{
    public function getBadges(string $name): array
    {
        $ratings = Rating::where("name", $name)->get();
        $averageRating = $ratings->avg("score");
        $numberOfRatings = $ratings->count();
        $hasNegativeRatings = (bool) $ratings->filter(function ($rating) {
            return $rating->score <= 2;
        })->count();
        $badges = [];
        if ($averageRating > 3) {
            $badges[] = "green place!";
        }
        if ($numberOfRatings > 4) {
            $badges[] = "rating promoter!";
        }
        if (!$hasNegativeRatings) {
            $badges[] = "never not green!";
        }
        return $badges;
    }
}
