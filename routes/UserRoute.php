<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

Route::name('users.')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index')
        ->middleware('permission:user_list');
    Route::get('list/', [UserController::class, 'list'])->name('list')
        ->middleware('permission:user_list');
    Route::post('/', [UserController::class, 'store'])->name('store')
        ->middleware('permission:user_create');
    Route::get('/{user}', [UserController::class, 'edit'])->name('edit')
        ->middleware('permission:user_edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update')
        ->middleware('permission:user_edit');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy')
        ->middleware('permission:user_delete');
});
