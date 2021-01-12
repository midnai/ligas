<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->string('pais', 50)->nullable();
            $table->string('ciudad', 150)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('estadio', 150)->nullable();
            $table->string('pagina_web', 150)->nullable();
            $table->string('logo', 250)->nullable();
            $table->date('fecha_fundacion')->nullable();
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
        Schema::dropIfExists('equipos');
    }
}
