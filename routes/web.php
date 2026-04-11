<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', [ProductController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
});

Route::middleware('auth')->get('/dashboard', function () {
    return match (Auth::user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'seller' => redirect()->route('seller.dashboard'),
        default => redirect('/'),
    };
})->name('dashboard');

Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', SellerProductController::class);
    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders');
    Route::patch('/order/{order}', [SellerOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/order/{order}', [SellerOrderController::class, 'show'])->name('order.show');
    Route::get('/transactions', [SellerController::class, 'transactions'])->name('transactions');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', AdminProductController::class);
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])
        ->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout/{cart}', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');
});

require __DIR__.'/auth.php';
