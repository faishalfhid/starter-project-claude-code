<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produk', [ProductController::class, 'index'])->name('products.index');

Route::get('/ui-preview', fn () => view('components.ui._preview'))->name('ui.preview');

Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/tambah', [CartController::class, 'add'])->name('cart.add');
Route::patch('/keranjang/update/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/keranjang/hapus/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
