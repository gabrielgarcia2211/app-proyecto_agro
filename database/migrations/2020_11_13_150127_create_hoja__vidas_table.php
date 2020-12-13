<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHojaVidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoja__vidas', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo');
            $table->string('archivo');
            $table->tinyInteger('autorizar');
            $table->foreign('codigo')
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
        Schema::dropIfExists('hoja__vidas');
    }
}
