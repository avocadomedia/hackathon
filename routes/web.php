<?php

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RatingController::class, 'index'])->name('ratings.index');
Route::get('/map', [RatingController::class, 'map'])->name('ratings.create-map');
Route::get('/create', [RatingController::class, 'create'])->name('ratings.create');
