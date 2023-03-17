<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/users/list', [UserController::class, 'index'])->name('users-list');
});

