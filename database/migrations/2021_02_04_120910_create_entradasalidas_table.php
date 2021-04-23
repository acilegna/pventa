<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradasalidas', function (Blueprint $table) {
            $table->increments('id_es');
            $table->integer('id_user');
            $table->integer('id_caja');
            $table->float('cantidad');
            $table->string('tipo');
            $table->timestamp('hora_fecha');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradasalidas');
    }
}
