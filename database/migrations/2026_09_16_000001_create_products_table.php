<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de produtos.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('preco', 10, 2);
            $table->string('unidade_medida', 20);
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela de produtos.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
