<?php
declare(strict_types=1);

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VisitorController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', [VisitorController::class, 'showCategories'])->name('home');
Route::get('/products/category/{category}', [VisitorController::class, 'showProductsByCategory'])->name('products.category');
Route::get('/product/{uuid}', [VisitorController::class, 'showProduct'])->name('product.show');
Route::get('/cart', [VisitorController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [VisitorController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{uuid}', [VisitorController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [VisitorController::class, 'clearCart'])->name('cart.clear');
Route::patch('/cart/update/{uuid}', [VisitorController::class, 'updateCartQuantity'])->name('cart.update');
Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout.form');
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/confirmation', [OrderController::class, 'orderConfirmation'])->name('order.confirmation');
Route::get('/contact', function () {
    return view('contact');
});


Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::prefix('admin')->middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

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
});
