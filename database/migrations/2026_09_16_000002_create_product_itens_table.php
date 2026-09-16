<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cria a tabela de itens de composição do produto.
     */
    public function up()
    {
        Schema::create('product_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantidade');
            $table->string('cor', 50);
            $table->decimal('valor', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Remove a tabela de itens do produto.
     */
    public function down()
    {
        Schema::dropIfExists('product_itens');
    }
};
