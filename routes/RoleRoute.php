<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RoleController;

Route::name('roles.')->prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index')
        ->middleware('permission:role_list');
    Route::get('/create', [RoleController::class, 'create'])->name('create')
        ->middleware('permission:role_create');
    Route::post('/', [RoleController::class, 'store'])->name('store')
        ->middleware('permission:role_create');
    Route::get('/{role}', [RoleController::class, 'show'])->name('show')
        ->middleware('permission:role_list');
    Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit')
        ->middleware('permission:role_edit');
    Route::put('/{role}', [RoleController::class, 'update'])->name('update')
        ->middleware('permission:role_edit');
    Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy')
        ->middleware('permission:role_delete');
});
