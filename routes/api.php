<?php

use App\Http\Controllers\ApiLocationRatingController;
use App\Http\Controllers\ApiRatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ratings', 'App\Http\Controllers\RatingController@fetchAll')->name('ratings.fetch-all');

Route::get('/ratings', 'App\Http\Controllers\RatingController@fetchAll')->name('ratings.fetch-all');

Route::prefix('v1')->group(function () {
    Route::controller(ApiRatingController::class)->group(function () {
        Route::get('/ratings', 'index');
        Route::post('/ratings', 'store');
    });
    Route::controller(ApiLocationRatingController::class)->group(function () {
        Route::get('/location-ratings/{pdok_id}', 'show');
    });
});
