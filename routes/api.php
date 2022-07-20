<?php

use App\Http\Controllers\Admin\ZonesByCountryController;
use App\Http\Controllers\SearchCustomerController;
use App\Http\Controllers\SearchProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api::', 'middleware' => ['auth:sanctum']], function() {
    Route::get('/zones-by-country/{country}', ZonesByCountryController::class)->name('zones-by-country');
    Route::post('/search/customers', SearchCustomerController::class)->name('search.customers');
    Route::post('/search/products', SearchProductController::class)->name('search.products');
});
