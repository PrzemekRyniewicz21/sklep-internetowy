<?php

// kolejna rzecz -> paginacja

use App\Http\Controllers\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
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


Route::middleware(['auth', 'verified'])->group(function() {

    Route::middleware(['can:isAdmin'])->group(function(){

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

        Route::get('/users',[UserController::class, 'destroy'])->name('user_delete');
        Route::get('/home/users-list', [UserController::class, 'index'])->name('users-list');
    }); 
    
    Route::get('/cart/list', [CartController::class, 'index'])->name('cart-index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart-store');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    
});
