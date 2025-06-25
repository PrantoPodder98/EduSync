<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\LostFoundController;
use App\Http\Controllers\Frontend\FoundItemsController;
use App\Http\Controllers\Frontend\LostItemsController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/lost-found', [LostFoundController::class, 'index'])->name('lost-found');
    Route::resource('found-items', FoundItemsController::class);
    Route::resource('lost-items', LostItemsController::class);
});

require __DIR__ . '/auth.php';
