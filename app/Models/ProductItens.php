<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductItens extends Model
{
    protected $table = 'product_itens';

    protected $fillable = [
        'product_id',
        'quantidade',
        'cor',
        'valor',
    ];

    protected $casts = [
        'quantidade' => 'decimal:3',
        'valor' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
