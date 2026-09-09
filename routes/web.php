<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItensController;
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

Route::redirect('/', '/produtos');
Route::get('/produtos', [ProductController::class, 'index'])->name('products.index');
Route::get('/produtos/{product}/itens', [ProductItensController::class, 'index'])->name('products.items.index');
