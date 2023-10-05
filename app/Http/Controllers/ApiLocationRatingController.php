<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Services\BadgeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApiLocationRatingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private BadgeService $badgeService;

    public function __construct(BadgeService $badgeService)
    {
        $this->badgeService = $badgeService;
    }

    public function show(Request $request, string $pdokId)
    {
        $ratings = Rating::where('pdok_id', $pdokId)->get();
        return [
           'numberOfRatings' => $ratings->count(),
           'averageScore' => $ratings->avg('score'),
           'comments' => $ratings->filter(function ($rating) {
               return $rating->comment;
           })->pluck('comment')->toArray(),
            'badges' => $this->badgeService->getBadges($pdokId)
        ];
    }
}
