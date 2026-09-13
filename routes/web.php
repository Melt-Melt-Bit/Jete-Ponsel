<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Support\ProductCatalog;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    if (! $request->filled('name') && $request->input('email') === 'admin' && $request->input('password') === 'admin') {
        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);

        return redirect()->route('admin.dashboard');
    }

    $request->validate([
        'name' => ['sometimes', 'required', 'string', 'max:255'],
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'min:8'],
        'password_confirmation' => ['sometimes', 'required', 'same:password'],
    ]);

    $message = $request->filled('name')
        ? 'Your account has been created.'
        : 'You are signed in.';

    return redirect()->route('home')->with('status', $message);
})->name('login.submit');

Route::get('/pembayaran', function () {
    return view('Pembayaran');
})->name('pembayaran');
Route::get('/detail/{product?}', function (?string $product = null) {
    return view('detail');
})->name('detail');
Route::get('/Cart', function () {
    return view('cart');
})->name('cart');

Route::get('/featured-product', function () {
    return view('featured-product', ['products' => ProductCatalog::visible()]);
})->name('featured-product');

Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
Route::put('/admin/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::patch('/admin/products/{product}/visibility', [AdminController::class, 'toggleProduct'])->name('admin.products.visibility');
Route::delete('/admin/products/{product}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
