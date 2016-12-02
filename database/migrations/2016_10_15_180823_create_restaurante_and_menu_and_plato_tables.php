<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestauranteAndMenuAndPlatoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->string('id_restaurante')->default('');
            $table->primary('id_restaurante');
            $table->float('lat')->default(0);
            $table->float('lng')->default(0);
            $table->integer('tipo')->default(0);
            $table->boolean('domicilio')->default(false);
            $table->boolean('terraza')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('eventos_deportivos')->default(false);
            $table->string('nombre_restaurante');
            $table->string('id_admin')->nullable();
            $table->string('updated_at');
            $table->string('indice_foto');
            $table->boolean('franquicia')->default(false);

        });

        Schema::create('menus', function(Blueprint $table) {
			$table->increments('id_menu');
			$table->string('id_restaurante');
			$table->foreign('id_restaurante')->references('id_restaurante')->on('restaurantes')->onDelete('cascade');

		});

        Schema::create('platos', function(Blueprint $table) {
			$table->increments('id_plato');
            $table->integer('id_menu')->unsigned()->default(0);
			$table->foreign('id_menu')->references('id_menu')->on('menus')->onDelete('cascade');
			$table->string('nombre')->default('');
			$table->float('precio')->default(0);
			$table->boolean('estrella')->default(false);
            $table->string('icono')->default('icono11.png');
            $table->string('categoria_plato');
            $table->string('updated_at');
            $table->integer('female')->unsigned()->default(1);
            $table->integer('male')->unsigned()->default(1);
            $table->integer('menor_edad')->unsigned()->default(1);
            $table->integer('mayor_edad')->unsigned()->default(1);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurante');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('plato');
    }
}
