<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaltasObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faltas_obras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra');
            $table->foreignId('funcionario');
            $table->boolean('falta');
            $table->boolean('meio_dia');
            $table->timestamps();

            $table->foreign('obra')->references('id')->on('obras')->onUpdate('cascade');
            $table->foreign('funcionario')->references('id')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faltas_obras');
    }
}
