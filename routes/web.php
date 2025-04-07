<?php
declare(strict_types=1);

use App\Http\Controllers\CategoryController;
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
