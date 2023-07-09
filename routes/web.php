<?php

// kolejna rzecz -> paginacja

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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


Route::get('/',[HelloController::class, 'show']);

Auth::routes();

Route::middleware('auth')->group(function() {


    Route::get('/products', [ProductController::class, 'index'])->name('products-list');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products-show');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products-create');
    Route::post('/products', [ProductController::class, 'store'])->name('products-store');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products-edit'); // {priduct} model binding !!!
    Route::post('/products/{product}', [ProductController::class, 'update'])->name('products-update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product-delete');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/users',[UserController::class, 'destroy'])->name('user_delete');
    Route::get('/home/users-list', [UserController::class, 'index'])->name('users-list');
});

// crud 23:20