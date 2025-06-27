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
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\RentalNoticeBoardAccommodationController;
use App\Http\Controllers\Frontend\RentalReservationController;
use App\Http\Controllers\Frontend\RentItemController;
use App\Http\Controllers\Frontend\RentOrderController;
use App\Http\Controllers\Frontend\RentCartController;

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
    Route::get('my-products', [SecondHandProductController::class, 'myProducts'])->name('second-hand-products.myProducts');
    Route::post('/orders/{order}/update-status', [SecondHandProductController::class, 'updateOrderStatus'])
        ->name('orders.update-status');

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

    // Payment routes
    Route::get('/payment/bkash', [PaymentController::class, 'showBkashPayment'])->name('payment.bkash');
    Route::post('/payment/bkash/process', [PaymentController::class, 'processBkashPayment'])->name('payment.bkash.process');

    // Rental Notice Board Accommodation routes
    Route::resource('rental-notice', RentalNoticeBoardAccommodationController::class);

    // Rental reservation routes
    Route::get('/rental/{id}/reserve', [RentalReservationController::class, 'showCheckout'])
        ->name('rental.reserve.checkout');
    Route::post('/rental/{id}/reserve', [RentalReservationController::class, 'processReservation'])
        ->name('rental.reserve.process');
    Route::get('/rental-notice-payment/card/{reservation}', [RentalReservationController::class, 'showCardPayment'])
        ->name('rental.payment.card');
    Route::post('/rental-notice-payment/card/{reservation}', [RentalReservationController::class, 'processCardPayment'])
        ->name('rental.payment.card.process');
    Route::get('/rental-notice-payments/bkash/{reservation}', [RentalReservationController::class, 'showBkashPayment'])
        ->name('rental.payment.bkash');
    Route::post('/rental-notice-payment/bkash/{reservation}', [RentalReservationController::class, 'processBkashPayment'])
        ->name('rental.payment.bkash.process');
    Route::get('/reservation/{reservation}/success', [RentalReservationController::class, 'showSuccess'])
        ->name('rental.reservation.success');
    Route::get('/my-reservations', [RentalReservationController::class, 'userReservations'])
        ->name('user.reservations');

    // Rental Order Item routes
    Route::resource('rent-items', RentItemController::class);
    Route::get('my-rent-items', [RentOrderController::class, 'myRentItems'])->name('rent-items.myRentItems');
    Route::post('rent-items/{rentItem}/update-status', [RentOrderController::class, 'updateOrderStatus'])
        ->name('rent-items.update-status');


    // Rent Cart routes
    Route::get('/rent-cart', [RentCartController::class, 'index'])->name('rent.cart.index');
    Route::post('/rent-cart/add/{rent_item}', [RentCartController::class, 'addToCart'])->name('rent.cart.add');
    Route::delete('/rent-cart/remove/{cartItem}', [RentCartController::class, 'removeFromCart'])->name('rent.cart.remove');
    Route::delete('/rent-cart/clear', [RentCartController::class, 'clearCart'])->name('rent.cart.clear');
    Route::get('/rent-cart/checkout', [RentCartController::class, 'checkout'])->name('rent.cart.checkout');


    // Rent Order routes
    Route::post('/rent-order/place', [RentOrderController::class, 'placeOrder'])->name('rent.order.place');
    Route::get('/rent-order/success/{order}', [RentOrderController::class, 'orderSuccess'])->name('rent.order.success');
    Route::get('/my-rent-orders', [RentOrderController::class, 'myOrders'])->name('rent.orders.index');
    Route::get('/rent-order/{order}', [RentOrderController::class, 'show'])->name('rent.order.show');
});

require __DIR__ . '/auth.php';
