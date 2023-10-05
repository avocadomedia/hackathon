<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
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
        return Rating::where('name', $request->name)->get();
    }

    public function store(Rating $rating, StoreRatingRequest $request)
    {
        $rating->score = $request->score;
        $rating->name = $request->name;
        $rating->latitude = 0;
        $rating->longitude = 0;
        $rating->address = 'keizersgracht 126';
        $rating->zip = '2020XX';
        $rating->comment = $request->comment;
        $rating->save();

        return $rating;
    }
}
