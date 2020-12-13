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
            $table->integer('idsaberpro');
            $table->integer('idsaber11');
            $table->bigInteger('documento');
            $table->timestamps();
            $table->foreign('documento')
                ->references('documento')
                ->on('estudiantes')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('idsaber11')
                ->references('idsaber11')
                ->on('saber11s')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('idsaberpro')
                ->references('idsaberpro')
                ->on('saber_pros')->onDelete('cascade')->onUpdate('cascade');;

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
