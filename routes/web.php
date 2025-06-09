<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    $categories = \App\Models\Category::withCount('products')->limit(3)->get();
    return view('welcome', compact('categories'));
});

Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('categories', CategoryController::class)->only(['index', 'show']);

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove', [CartController::class, 'remove'])->name('cart.remove');
});

Route::resource('orders', OrderController::class)->only(['create', 'store']);
Route::get('/orders/success/{order}', [OrderController::class, 'success'])->name('orders.success');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');