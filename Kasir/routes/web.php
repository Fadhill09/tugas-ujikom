<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
    // return view('kasir.dashboard');
    // return view('kasir.histori');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/Menu', [ProductController::class, 'index'])->name('products.index');
    Route::get('/admin/tambah', [ProductController::class, 'create'])->name('products.create');
    Route::post('/tambah', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/admin/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/admin/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/admin/struk/histori', [ProductController::class, 'history'])->name('checkout.history');

    Route::resource('/admin/categories', CategoryController::class);
});

// Kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.dashboard');

    Route::get('/checkout/tambah/', [CheckoutController::class, 'index'])->name('checkout.form');
    Route::post('/kasir/struk', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/store/{id}', [CheckoutController::class, 'hasil'])->name('checkout.hasil');
    Route::get('/checkout/struk/{id}', [CheckoutController::class, 'download'])->name('checkout.download');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
