<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::name('categories.')->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index')
        ->middleware('permission:category_list');
    Route::get('list/', [CategoryController::class, 'list'])->name('list')
        ->middleware('permission:category_list');
    Route::post('/', [CategoryController::class, 'store'])->name('store')
        ->middleware('permission:category_create');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show')
        ->middleware('permission:category_edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update')
        ->middleware('permission:category_edit');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')
        ->middleware('permission:category_delete');
});
