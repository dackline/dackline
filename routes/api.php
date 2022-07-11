<?php

use App\Http\Controllers\Admin\ZonesByCountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/zones-by-country/{country}', ZonesByCountryController::class)->name('zones-by-country');
});
