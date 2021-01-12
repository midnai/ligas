<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('foto', 150)->nullable();
            $table->string('posicion', 20)->nullable();
            $table->string('seleccion', 50)->nullable();
            $table->string('nacionalidad', 50)->nullable();
            $table->integer('total_goles')->nullable();
            $table->float('peso', 4, 2)->nullable();
            $table->float('altura', 4, 2)->nullable();
            $table->dateTime('nacimiento')->nullable();
            $table->dateTime('debut')->nullable();
            $table->bigInteger('equipo_id')->unsigned()->nullable();

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
        Schema::dropIfExists('jugadores');
    }
}
