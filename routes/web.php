<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\LostFoundController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::get('/lost-found', [LostFoundController::class, 'index'])->name('lost-found');
    Route::get('/lost-found/lost', [LostFoundController::class, 'lost_list'])->name('lost-found.lost');
    Route::get('/lost-report', [LostFoundController::class, 'lost_report'])->name('lost-found.lost.report');
    Route::get('/lost-found/found', [LostFoundController::class, 'found_list'])->name('lost-found.found');
    Route::get('/found-report', [LostFoundController::class, 'found_report'])->name('lost-found.found.report');

});

require __DIR__ . '/auth.php';
