<?php
declare(strict_types=1);

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/create/category', [CategoryController::class, 'create'])->name('category.create');
Route::post('create/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/{uuid}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('update/category/{uuid}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('delete/category/{uuid}', [CategoryController::class, 'destroy'])->name('category.delete');


Route::get('products', [ProductController::class, 'index'])->name('product.index');
Route::get('/create/product', [ProductController::class, 'create'])->name('product.create');
Route::post('/create/product', [ProductController::class, 'store'])->name('product.store');
Route::get('product/{uuid}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('update/product/{uuid}', [ProductController::class, 'update'])->name('product.update');
Route::delete('delete/product/{uuid}', [ProductController::class, 'destroy'])->name('product.delete');

Route::get('stock', [StockController::class, 'index'])->name('stock.index');
Route::get('/create/stock', [StockController::class, 'create'])->name('stock.create');
Route::post('create/stock', [StockController::class, 'store'])->name('stock.store');
Route::get('stock/{uuid}', [StockController::class, 'edit'])->name('stock.edit');
Route::put('update/stock/{uuid}', [StockController::class, 'update'])->name('stock.update');
Route::delete('delete/stock/{uuid}', [StockController::class, 'destroy'])->name('stock.delete');
