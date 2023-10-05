<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRatingRequest;
use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Http\RedirectResponse;
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

    public function store(StoreRatingRequest $request): RedirectResponse
    {
        Rating::create($request->validated());

        return redirect()
            ->route('ratings.index')
            ->with('success', 'Bedankt voor je beoordeling!');
    }

    public function map(): View
    {
        return view('livewire.map');
    }
}
