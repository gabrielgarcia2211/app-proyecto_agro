<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa__estudiantes', function (Blueprint $table) {
            $table->id();
            $table->integer('nitemprea')->unique();
            $table->integer('codigoestudiante')->unique();
            $table->foreign('codigoestudiante')
                ->references('codigo')
                ->on('users');
            $table->foreign('nitemprea')
                ->references('nit')
                ->on('empresas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa__estudiantes');
    }
}
