<?php

namespace App\Http\Controllers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\View\View;

class RatingController extends Controller
{
    public function index(): View
    {
        return view('ratings.index');
    }

    /**
     * Temporary API endpoint for fetching all ratings.
     */
    public function fetchAll(): AnonymousResourceCollection
    {
        return RatingResource::collection(Rating::all());
    }

    public function create(): View
    {
        return view('ratings.create');
    }
}
