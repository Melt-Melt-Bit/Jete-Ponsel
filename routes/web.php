<?php

use App\Http\Controllers\AccountOrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->whereNumber('product')->name('products.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:6,1')->name('login.submit');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:6,1')->name('register.submit');
});

Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'store'])->whereNumber('product')->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->whereNumber('product')->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->whereNumber('product')->name('cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/orders/confirmation/{order:order_number}', [CheckoutController::class, 'confirmation'])->name('orders.confirmation');

Route::middleware('auth')->prefix('my/orders')->name('account.orders.')->group(function () {
    Route::get('/', [AccountOrderController::class, 'index'])->name('index');
    Route::get('/{order}', [AccountOrderController::class, 'show'])->whereNumber('order')->name('show');
});

Route::get('/profile', [AccountOrderController::class, 'profile'])
    ->middleware('auth')
    ->name('profile');

Route::middleware(['auth', EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class)->only(['store', 'update', 'destroy']);
    Route::patch('/products/{product}/visibility', [ProductController::class, 'toggleVisibility'])
        ->whereNumber('product')
        ->name('products.visibility');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])
        ->whereNumber('order')
        ->name('orders.status');
});

Route::get('/incomplete', fn () => view('incomplete'))->name('incomplete');
