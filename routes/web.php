<?php

// namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\LostFoundController;
use App\Http\Controllers\Frontend\FoundItemsController;
use App\Http\Controllers\Frontend\LostItemsController;
use App\Http\Controllers\Frontend\SecondHandProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\OrderController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    // profile rourtes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // dashboard rourtes
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    // lost and found rourtes
    Route::get('/lost-found', [LostFoundController::class, 'index'])->name('lost-found');
    Route::resource('found-items', FoundItemsController::class);
    Route::resource('lost-items', LostItemsController::class);

    // second hand products rourtes
    Route::resource('second-hand-products', SecondHandProductController::class);
    // Route::get('/get-secondhand-items', [SecondHandProductController::class, 'getItems']);

    // cart rourtes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

    // Order routes
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/success/{order}', [OrderController::class, 'orderSuccess'])->name('order.success');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
});

require __DIR__ . '/auth.php';
