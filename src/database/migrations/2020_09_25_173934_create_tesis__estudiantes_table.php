<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesisEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesis__estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tesis');
            $table->integer('codigoestudiante')->unique();
            $table->timestamps();
            $table->foreign('id_tesis')
                ->references('codigo')
                ->on('teses');
            $table->foreign('codigoestudiante')
                ->references('codigo')
                ->on('users');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tesis__estudiantes');
    }
}
