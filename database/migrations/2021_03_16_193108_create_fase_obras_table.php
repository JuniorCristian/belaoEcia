<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_obras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra');
            $table->foreignId('fase');
            $table->date('inicio')->nullable();
            $table->date('final')->nullable();
            $table->date('inicio_previsto')->nullable();
            $table->date('final_previsto')->nullable();
            $table->boolean('status_db');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('obra')->references('id')->on('obras');
            $table->foreign('fase')->references('id')->on('fases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fase_obras');
    }
}
