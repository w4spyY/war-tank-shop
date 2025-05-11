<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\TankController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;

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
    Route::get('/my-orders', [ProfileController::class, 'orders'])->name('profile.orders');
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

// ADMIN PANEL
Route::get('/admin-panel', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('admin.index');
    }
    abort(403, 'Acceso no autorizado');
})->middleware('auth')->name('admin.panel');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/products', [AdminController::class, 'productList'])->name('admin.products.list');
    Route::get('/products/low-stock', [AdminController::class, 'lowStockProducts'])->name('admin.products.low-stock');
    Route::get('/products/exhausted', [AdminController::class, 'exhaustedProducts'])->name('admin.products.exhausted');

    Route::get('/sales-history', [AdminController::class, 'salesHistory'])->name('admin.sales.history');
    
    //grafico stock
    Route::get('/stock-graph', [AdminController::class, 'stockGraph'])->name('admin.stock.graph');
    Route::get('/api/stock-data', [AdminController::class, 'getStockData'])->name('admin.stock.data');

    //grafico ventas
    Route::get('/sales-graph', [AdminController::class, 'salesGraph'])->name('admin.sales.graph');
    Route::get('/api/sales-data', [AdminController::class, 'getSalesData'])->name('admin.sales.data');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::prefix('catalog')->group(function () {
        Route::get('/categories', [AdminController::class, 'categories'])->name('admin.catalog.categories');
        Route::get('/products', [AdminController::class, 'products'])->name('admin.catalog.products');
        Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.catalog.products.create');

        //eliminar y editar categoria
        Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.catalog.categories.destroy');
        Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.catalog.categories.update');
    
        //edlimiar y editar tanque/pieza
        Route::delete('/tanks/{tank}', [AdminController::class, 'destroyTank'])->name('admin.catalog.tanks.destroy');
        Route::put('/tanks/{tank}', [AdminController::class, 'updateTank'])->name('admin.catalog.tanks.update');
        Route::delete('/parts/{part}', [AdminController::class, 'destroyPart'])->name('admin.catalog.parts.destroy');
        Route::put('/parts/{part}', [AdminController::class, 'updatePart'])->name('admin.catalog.parts.update');
        
        //crear tanques/piezas
        Route::post('/tanks', [AdminController::class, 'storeTank'])->name('admin.catalog.tanks.store');
        Route::post('/parts', [AdminController::class, 'storePart'])->name('admin.catalog.parts.store');
    });
});

//carrito
Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/sync', [CartController::class, 'sync'])->name('cart.sync');
});

Route::prefix('api')->group(function() {
    Route::middleware('auth:sanctum')->post('/cart/sync', [CartController::class, 'apiSync']);
});

Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
Route::get('/checkout/confirmation/{invoice}', [CartController::class, 'confirmation'])->name('cart.confirmation');

//para ver pedidos
Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');

//descargar pedido
Route::get('/invoice/{invoice}/download', [InvoiceController::class, 'downloadPdf'])->name('invoice.download');

//enviar pedido al correo
Route::post('/invoice/{invoice}/send', [InvoiceController::class, 'sendEmail'])->name('invoice.send');

require __DIR__.'/auth.php';
