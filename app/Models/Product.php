<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'nome',
        'preco',
        'unidade_medida',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
    ];

    /**
     * Itens de composição do produto.
     */
    public function itens()
    {
        return $this->hasMany(ProductItens::class, 'product_id');
    }
}
