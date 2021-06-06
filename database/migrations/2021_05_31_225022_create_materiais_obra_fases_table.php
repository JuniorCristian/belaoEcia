<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaisObraFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiais_obra_fases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material');
            $table->foreignId('loja');
            $table->foreignId('fase_obra');
            $table->date('data_compra');
            $table->float('preco_unitario');
            $table->float('qtd');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('material')->references('id')->on('materiais');
            $table->foreign('loja')->references('id')->on('lojas');
            $table->foreign('fase_obra')->references('id')->on('fase_obras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materiais_obra_fases');
    }
}
