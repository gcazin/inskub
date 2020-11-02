<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Administration
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');

    Route::prefix('user')->name('user.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
    });

    Route::prefix('faq')->name('faq.')->group(function() {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::post('/', [FaqController::class, 'store'])->name('store');
    });
});
