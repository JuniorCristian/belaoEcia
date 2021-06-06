<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente');
            $table->double('orcamento', '8,2');
            $table->double('orcamento_material', '8,2')->nullable();
            $table->boolean('has_orcamento_material');
            $table->dateTime('data_inicio_prevista')->nullable();
            $table->dateTime('data_final_prevista')->nullable();
            $table->dateTime('data_inicio')->nullable();
            $table->dateTime('data_final')->nullable();
            $table->string('cep')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf')->nullable();
            $table->boolean('status_db');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cliente')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obras');
    }
}
