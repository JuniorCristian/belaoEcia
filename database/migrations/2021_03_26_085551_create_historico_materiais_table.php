<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricoMateriaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_materiais', function (Blueprint $table) {
            $table->id();
            $table->foreignId("material");
            $table->foreignId("loja");
            $table->dateTime("data");
            $table->float("preco");
            $table->timestamps();

            $table->foreign("material")->on("materiais")->references("id");
            $table->foreign("loja")->on("lojas")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historico_materiais');
    }
}
