<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class RatingController extends Controller
{
    public function index(): View
    {
        return view('ratings.index');
    }

    public function create(): View
    {
        return view('ratings.create');
    }
}
