<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with(['itens' => function ($query) {
            $query->orderBy('id');
        }])->orderBy('nome')->orderBy('id')->get();

        return view('products.index', compact('products'));
    }
}
