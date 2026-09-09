<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'nome' => 'Cadeira de escritório',
                'preco' => '649.90',
                'unidade_medida' => 'un',
                'itens' => [
                    ['quantidade' => '4.000', 'cor' => 'Preto', 'valor' => '35.50'],
                    ['quantidade' => '1.000', 'cor' => 'Cinza', 'valor' => '129.90'],
                ],
            ],
            [
                'nome' => 'Mesa de jantar',
                'preco' => '1199.90',
                'unidade_medida' => 'un',
                'itens' => [
                    ['quantidade' => '4.000', 'cor' => 'Carvalho', 'valor' => '89.90'],
                    ['quantidade' => '1.000', 'cor' => 'Branco', 'valor' => '249.90'],
                ],
            ],
            [
                'nome' => 'Tecido para cortina',
                'preco' => '59.90',
                'unidade_medida' => 'm',
                'itens' => [
                    ['quantidade' => '2.500', 'cor' => 'Areia', 'valor' => '39.90'],
                    ['quantidade' => '0.750', 'cor' => 'Marfim', 'valor' => '19.90'],
                ],
            ],
        ];

        DB::transaction(function () use ($products) {
            foreach ($products as $attributes) {
                $items = $attributes['itens'];
                unset($attributes['itens']);

                $product = Product::updateOrCreate(['nome' => $attributes['nome']], $attributes);

                foreach ($items as $item) {
                    $product->itens()->updateOrCreate(['cor' => $item['cor']], $item);
                }
            }
        });
    }
}
