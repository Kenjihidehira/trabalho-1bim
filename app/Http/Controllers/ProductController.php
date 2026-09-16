<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Lista todos os produtos juntamente com seus itens.
     */
    public function index()
    {
        $products = Product::with('itens')->orderBy('nome')->get();

        return view('products.index', [
            'products' => $products,
            'title' => 'Lista de Produtos e Itens',
        ]);
    }
}
