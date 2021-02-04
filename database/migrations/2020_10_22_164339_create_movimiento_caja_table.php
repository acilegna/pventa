<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoCajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_caja', function (Blueprint $table) {
            $table->increments('id');  
            $table->integer('id_caja');
            $table->integer('id_usu');
            $table->float('dinero_inicial')->unique();
            $table->float('acomulado_ventas');
            $table->decimal('acomulado_entradas');   
            $table->decimal('acomulado_salidas');   
            $table->integer('efectivo_cierre')->unique();
            $table->float('total_caja')->default(0);
            $table->integer('numero_ventas');
            $table->string('status');
            $table->string('inicio_en'); 
            $table->string('termino_en');     
        
        });
    }
 
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_caja');
    }
}
