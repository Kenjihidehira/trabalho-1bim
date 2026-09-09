<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductItensController extends Controller
{
    public function index(Product $product): View
    {
        $product->load(['itens' => function ($query) {
            $query->orderBy('id');
        }]);

        return view('products.items', compact('product'));
    }
}
