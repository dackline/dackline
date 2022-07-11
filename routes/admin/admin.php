<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerGroupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\GeoZoneController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\ZoneController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin::', 'prefix' => 'admin'], function() {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resources([
            'currencies' => CurrencyController::class,
            'countries' => CountryController::class,
            'zones' => ZoneController::class,
            'geo-zones' => GeoZoneController::class,
            'taxes' => TaxController::class,
            'stores' => StoreController::class,
            'informations' => InformationController::class,
            'manufacturers' => ManufacturerController::class,
            'categories' => CategoryController::class,
            'options' => OptionController::class,
            'products' => ProductController::class,
            'customer-groups' => CustomerGroupController::class,
            'customers' => CustomerController::class,
        ]);

        Route::get('file-manager', [FileManagerController::class, 'index'])->name('file-manager');

        Route::get('lang/{locale}', [LanguageController::class, 'swap']);
    });

    require __DIR__.'/auth.php';
});
