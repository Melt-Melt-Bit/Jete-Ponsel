<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/detail', function () {
    return view('detail');
})->name('detail');
Route::get('/Cart', function () {
    return view('cart');
})->name('cart');

Route::get('/featured-product', function () {
    return view('featured-product');
})->name('featured-product');
