<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('empleo');
            $table->string('jornada');
            $table->string('salario');
            $table->string('telefono');
            $table->string('descripcion');
            $table->string('requerimientos');
            $table->integer('nitemprea');
            $table->foreign('nitemprea')
                ->references('nit')
                ->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
