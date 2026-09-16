<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItens extends Model
{
    use HasFactory;

    protected $table = 'product_itens';

    protected $fillable = [
        'product_id',
        'quantidade',
        'cor',
        'valor',
    ];

    protected $casts = [
        'quantidade' => 'integer',
        'valor' => 'decimal:2',
    ];

    /**
     * Produto ao qual o item pertence.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
