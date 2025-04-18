<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TankController;




//MAIN PAGE
Route::get('/', [TankController::class, 'index'])->name('main.index');
//TANK-DETAILS
Route::get('/tank/{id}', [TankController::class, 'show'])->name('tank.details');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





//COOKIES AND TERMS
Route::get('/cookies', function () {
    return view('terms-cookies.cookies');
});
Route::get('/terms', function () {
    return view('terms-cookies.terms');
});

// ABOUT US
Route::get('/about-us', function () {
    return view('about-us.index');
})->name('about-us');

// CART
Route::get('/cart', function () {
    return view('cart.index');
})->name('cart');

// MY PROFILE
Route::get('/my-profile', function () {
    return view('my-profile.index');
})->name('my-profile');

require __DIR__.'/auth.php';
