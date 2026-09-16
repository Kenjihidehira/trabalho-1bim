<?php

namespace App\Http\Controllers;

use App\Models\ProductItens;

class ProductItensController extends Controller
{
    /**
     * Lista todos os itens com o produto a que pertencem.
     */
    public function index()
    {
        $itens = ProductItens::with('product')->get();

        return response()->json($itens);
    }
}
