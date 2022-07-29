<?php

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

Route::get('/test', function() {
    $item = \App\Models\OrderData::where('id', 4)->with('order', 'order.assignee', 'order.products')->first();
    $data = $item->order;
    $type = 'order';
    $totals = $data->getTotals();
    return view('admin.orders.invoice', compact('item', 'data', 'type', 'totals'));
});

require __DIR__.'/admin/admin.php';

//require __DIR__.'/auth.php';
