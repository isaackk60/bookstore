<?php

// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/book', BooksController::class);
Route::resource('/cart', CartController::class);
Route::post('/cart', [CartController::class, 'store'])->name('cart.store'); 
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update'); 
// this is shopping cart route
Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
// Route::resource('/cart', CartController::class)->except(['index']);
// Route::resource('/cart', CartController::class)->except(['index', 'create', 'store']);

// this is user information Route.
Route::middleware(['auth'])->get('/userinfo', [AdminController::class, 'index'])->name('user.userinfo');

// Route::get('/userinfo','AdminController@userinfo')->name('userinfo');

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
