<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->string('referencia')->index()->unique();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->string('preco');
            $table->integer('promocao');
            $table->string('composicao');
            $table->string('marca');
            $table->boolean('integrado')->default(false);
            $table->timestamps();
        });

        Schema::create('variacoes', function (Blueprint $table) {
            $table->string('produto_referencia')->index();
            $table->string('variacao')->index()->unique();
            $table->string('tamanho');
            $table->string('cor');
            $table->integer('quantidade');
            $table->integer('ordem');
            $table->string('unidade');
            $table->timestamps();
        });

        Schema::table('variacoes', function (Blueprint $table) {
            $table->foreign('produto_referencia')->references('referencia')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variacoes');
        Schema::dropIfExists('produtos');
    }
};
