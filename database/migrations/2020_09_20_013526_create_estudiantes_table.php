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
            $table->bigInteger('documento')->unique();
            $table->tinyInteger('egresado')->nullable();;
            $table->integer('semestreCursado');
            $table->integer('materiasAprobadas');
            $table->double('promedio');
            $table->date('fechaingreso');
            $table->date('fechaegreso')->nullable();
            $table->integer('id_historial')->nullable();
            $table->timestamps();
            $table->foreign('documento')
                ->references('documento')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

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
