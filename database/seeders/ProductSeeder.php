<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Cadastra produtos de exemplo com seus itens.
     */
    public function run()
    {
        $camiseta = Product::create([
            'nome' => 'Camiseta Básica',
            'preco' => 49.90,
            'unidade_medida' => 'UN',
        ]);

        $camiseta->itens()->createMany([
            ['quantidade' => 10, 'cor' => 'Preta', 'valor' => 49.90],
            ['quantidade' => 5, 'cor' => 'Branca', 'valor' => 49.90],
        ]);

        $tecido = Product::create([
            'nome' => 'Tecido Algodão',
            'preco' => 32.50,
            'unidade_medida' => 'M',
        ]);

        $tecido->itens()->createMany([
            ['quantidade' => 30, 'cor' => 'Azul', 'valor' => 32.50],
        ]);
    }
}
