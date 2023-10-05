<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApiRatingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {
        return Rating::where("pdok_id", $request->pdokId)->get();
    }

    public function store(Rating $rating, Request $request)
    {
        $rating->score = $request->score;
        $rating->pdok_id = $request->pdokId;
        $rating->pdok_latitude = 0;
        $rating->pdok_longitude = 0;
        $rating->comment = $request->comment;
        $rating->save();
        return $rating;
    }
}
