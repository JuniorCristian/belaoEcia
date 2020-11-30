<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios_obras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionario');
            $table->foreignId('obra');
            $table->timestamps();

            $table->foreign('funcionario')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->foreign('obra')->references('id')->on('obras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios_obras');
    }
}
