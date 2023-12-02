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


Route::get('/', [WelcomeController::class, 'index']);
Route::get('/hello', [HelloController::class, 'show']);

// TYMCZASOWO
Route::get('hurt/list', [HurtowniaController::class, 'index'])->name('hurtownia.index');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['can:isAdmin'])->group(function () {

        Route::get('products/{product}/donwload', [ProductController::class, 'download_img'])->name('products-download-img');

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products-list');
            Route::get('/create', [ProductController::class, 'create'])->name('products-create');
            Route::post('/', [ProductController::class, 'store'])->name('products-store');
            Route::get('/{product}', [ProductController::class, 'show'])->name('products-show');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('products-edit'); // {product} model binding !!!
            Route::post('/{product}', [ProductController::class, 'update'])->name('products-update');
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product-delete');
        });

        Route::prefix('hurtownia')->group(function () {

            Route::get('/list', [HurtowniaController::class, 'index'])->name('hurtownia.index');
            Route::post('/add_element', [HurtowniaController::class, 'store2'])->name('hurtownia.store'); // problem z POST przez ajax dlatego GET
        });

        Route::resource('users', UserController::class)->only([

            'destroy', 'index', 'update', 'edit'

        ]);
    });

    Route::get('/cart', [CartController::class, 'index'])->name('cart-index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart-store');
    Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart-delete');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');



    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
