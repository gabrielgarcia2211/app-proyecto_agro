<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('documento')->unique();
            $table->tinyInteger('egresado')->nullable();;
            $table->string('semestreCursado');
            $table->integer('materiasAprobadas');
            $table->double('promedio');
            $table->date('fechaIngreso');
            $table->date('fechaEgreso')->nullable();
            $table->integer('id_historial')->nullable();
            $table->timestamps();
            $table->foreign('documento')
                ->references('documento')
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
        Schema::dropIfExists('estudiantes');
    }
}
