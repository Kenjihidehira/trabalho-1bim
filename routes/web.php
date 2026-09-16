<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductItensController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Lista todos os produtos juntamente com seus itens
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Lista todos os itens de produto (JSON)
Route::get('/product-itens', [ProductItensController::class, 'index'])->name('product-itens.index');
