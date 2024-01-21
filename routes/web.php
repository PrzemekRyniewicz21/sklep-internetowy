<?php

// kolejna rzecz -> paginacja

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HurtowniaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

// Dostepne dla niezalogowanych
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products-show');

// TYMCZASOWO
// Route::get('hurt/list', [HurtowniaController::class, 'index'])->name('hurtownia.index');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['can:isAdmin'])->group(function () {

        Route::get('products/{product}/donwload', [ProductController::class, 'download_img'])->name('products-download-img');

        Route::prefix('products')->group(function () {

            Route::get('/', [ProductController::class, 'index'])->name('products-list');
            Route::get('/create', [ProductController::class, 'create'])->name('products-create');
            Route::post('/', [ProductController::class, 'store'])->name('products-store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products-edit'); // {product} model binding !!!
            Route::put('/{product}', [ProductController::class, 'update'])->name('products-update');

            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product-delete');
        });

        Route::prefix('hurtownia')->group(function () {

            Route::get('/list', [HurtowniaController::class, 'index'])->name('hurtownia.index');
            Route::post('/add_element', [HurtowniaController::class, 'store'])->name('hurtownia.store'); // naprawione 
            Route::get('/game_des/{id}', [HurtowniaController::class, 'show'])->name('hurtownia.show');
        });

        Route::resource('users', UserController::class)->only([

            'index', 'update', 'edit', 'destroy'

        ]);
    });

    Route::get('/cart', [CartController::class, 'index'])->name('cart-index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart-store');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart-delete');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('order.update');

    // Route::get('/home', [HomeController::class, 'index'])->name('home');
});
