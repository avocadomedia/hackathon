<?php

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RatingController::class, 'index'])->name('ratings.index');
Route::get('/create', [RatingController::class, 'create'])->name('ratings.create');
