<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [TipController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('tips', TipController::class)->middleware('auth');

Route::resource('categories', CategoryController::class)->only(['store', 'update', 'destroy'])->middleware('auth');
