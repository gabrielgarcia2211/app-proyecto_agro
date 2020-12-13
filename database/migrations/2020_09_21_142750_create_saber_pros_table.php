<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaberProsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saber_pros', function (Blueprint $table) {
            $table->integer('idsaberpro')->primary();
            $table->integer('lectura_critica');
            $table->integer('razonamiento_cuantitativo');
            $table->integer('competencias_ciudadana');
            $table->integer('comunicacion_escrita');
            $table->integer('ingles');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saber_pros');
    }
}
