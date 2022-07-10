<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::name('products.')->prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index')
        ->middleware('permission:product_list');
    Route::get('list/', [ProductController::class, 'list'])->name('list')
        ->middleware('permission:product_list');
    Route::post('/', [ProductController::class, 'store'])->name('store')
        ->middleware('permission:product_create');
    Route::get('/{id}', [ProductController::class, 'show'])->name('show')
        ->middleware('permission:product_list');
    Route::post('/{id}', [ProductController::class, 'update'])->name('update')
        ->middleware('permission:product_edit');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy')
        ->middleware('permission:product_delete');
});
