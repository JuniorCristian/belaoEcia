<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseObraImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_obra_imagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fase_obra');
            $table->string('path');
            $table->boolean('status_db');
            $table->timestamps();

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
        Schema::dropIfExists('fase_obra_imagens');
    }
}
