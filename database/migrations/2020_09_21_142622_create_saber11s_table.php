<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaber11sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saber11s', function (Blueprint $table) {
            $table->integer('idsaber11')->primary();
            $table->integer('lectura_critica');
            $table->integer('matematicas');
            $table->integer('sociales_ciudadanas');
            $table->integer('naturales');
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
        Schema::dropIfExists('saber11s');
    }
}
