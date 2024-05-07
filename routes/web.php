<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainPageController::class, 'index']);
Route::resource('/sales', SalesController::class);
Route::resource('/book', BooksController::class);
Route::resource('/cart', CartController::class);

Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store'); 
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update'); 

Route::middleware(['auth'])->get('/users/{user}/sales', [AdminController::class, 'showSales'])->name('user.sales');

Route::middleware(['auth'])->get('/userinfo', [AdminController::class, 'index'])->name('user.userinfo');
Route::middleware(['auth'])->delete('/userinfo/delete/{id}', [AdminController::class, 'destroy'])->name('user.destroy');

Route::get('/book', [BooksController::class, 'index'])->name('book.index');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';