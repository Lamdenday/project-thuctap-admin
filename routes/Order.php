<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\OrderController;

Route::name('order.')->prefix('order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('list/', [OrderController::class, 'list'])->name('list');
    Route::get('/{id}', [OrderController::class, 'show'])->name('show');

});
