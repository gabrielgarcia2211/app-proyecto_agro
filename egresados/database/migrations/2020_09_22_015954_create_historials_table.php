<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id();
            $table->integer('idSaberPro');
            $table->integer('idSaber11');
            $table->integer('documento');
            $table->timestamps();
            $table->foreign('documento')
                ->references('documento')
                ->on('estudiantes');
            $table->foreign('idSaber11')
                ->references('idSaber11')
                ->on('saber11s');
            $table->foreign('idSaberPro')
                ->references('idSaberPro')
                ->on('saber_pros');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historials');
    }
}
