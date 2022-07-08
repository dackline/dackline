<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerGroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\GeoZoneController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [StaterkitController::class, 'home'])->name('home');
// Route::get('home', [StaterkitController::class, 'home'])->name('home');
// // Route Components
// Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
// Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
// Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
// Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
// Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');

Route::get('/', function() {
    return 'Welcome to dackline';
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'currencies' => CurrencyController::class,
    ]);
    Route::resources([
        'countries' => CountryController::class,
    ]);
    Route::resources([
        'zones' => ZoneController::class,
    ]);
    Route::resources([
        'geo-zones' => GeoZoneController::class,
    ]);
    Route::resources([
        'taxes' => TaxController::class,
    ]);
    Route::resources([
        'stores' => StoreController::class,
    ]);
    Route::resources([
        'informations' => InformationController::class,
    ]);
    Route::resources([
        'manufacturers' => ManufacturerController::class,
    ]);
    Route::resources([
        'categories' => CategoryController::class,
    ]);
    Route::resources([
        'options' => OptionController::class,
    ]);
    Route::resources([
        'products' => ProductController::class,
    ]);
    Route::resources([
        'customer-groups' => CustomerGroupController::class,
    ]);

    Route::get('file-manager', [FileManagerController::class, 'index'])->name('file-manager');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('lang/{locale}', [LanguageController::class, 'swap']);
});

require __DIR__.'/auth.php';
