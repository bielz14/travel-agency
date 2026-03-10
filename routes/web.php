<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;

// --- Авторизація ---
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- Реєстрація ---
Route::get('/register',  [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/',HomeController::class)->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile',          [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile',          [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/checkout',          [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout',         [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{booking}', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/tours',[TourController::class,'index'])->name('tours.index');

Route::get('/tours/{tour}', [TourController::class,'show'])->name('tours.show');

Route::get('/cart', [CartController::class,'index'])->name('cart.index');

Route::post('/cart/add/{tour}', [CartController::class,'add'])->name('cart.add');
