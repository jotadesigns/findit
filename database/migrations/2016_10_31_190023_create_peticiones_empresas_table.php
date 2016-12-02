<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeticionesEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticiones_empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_admin')->unsigned()->default(0);
            $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
            $table->string('id_restaurante');
            $table->foreign('id_restaurante')->references('id_restaurante')->on('restaurantes')->onDelete('cascade');
            $table->string('mensaje')->nullable();
            $table->boolean('activado')->default(false);
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
        Schema::dropIfExists('peticiones_empresas');
    }
}
