<?php

namespace App\Http\Controllers\Api;

use App\Models\Rating;
use App\Services\BadgeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LocationRatingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private BadgeService $badgeService;

    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    public function show(string $name)
    {
        $ratings = Rating::where('name', 'LIKE', "%$name%")->get();
        return [
            'name' => $name,
            'numberOfRatings' => $ratings->count(),
            'averageScore' => $ratings->avg('score'),
            'comments' => $ratings->filter(function ($rating) {
                return $rating->comment;
            })->unique('comment')->pluck('comment')->toArray(),
            'badges' => $this->badgeService->getBadges($name)
        ];
    }
}
