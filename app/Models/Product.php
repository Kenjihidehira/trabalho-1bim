<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'nome',
        'preco',
        'unidade_medida',
    ];

    protected $casts = [
        'preco' => 'decimal:2',
    ];

    public function itens(): HasMany
    {
        return $this->hasMany(ProductItens::class, 'product_id');
    }
}
