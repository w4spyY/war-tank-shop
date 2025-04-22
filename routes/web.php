<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\TankController;
use App\Http\Controllers\AdminController;




//MAIN PAGE
Route::get('/', [TankController::class, 'index'])->name('main.index');
//TANK-DETAILS
Route::get('/tank/{id}', [TankController::class, 'show'])->name('tank.details');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/my-profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/my-profile', [ProfileController::class, 'update'])->name('profile.update');
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

// ADMIN PANEL
Route::get('/admin-panel', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('admin.index');
    }
    abort(403, 'Acceso no autorizado');
})->middleware('auth')->name('admin.panel');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/products', [AdminController::class, 'productList'])->name('admin.products.list');
    // Otras rutas de admin...
});

require __DIR__.'/auth.php';
