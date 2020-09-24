<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('documento')->primary();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('celular', 10);
            $table->string('correo', 100);
            $table->string('telefono', 7);
            $table->string('tipo_documento', 15);
            $table->string('direccion', 15);
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
        Schema::dropIfExists('personas');
    }
}
