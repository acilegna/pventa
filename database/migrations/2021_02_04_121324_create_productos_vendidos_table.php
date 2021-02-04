<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosVendidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_vendidos', function (Blueprint $table) {
            $table->increments('id');  
            $table->integer('id_venta');
            $table->integer('id_user')->default(1);
            $table->integer('id_producto');
            $table->string('descripcion'); 
            $table->decimal('precio');   
            $table->decimal('cantidad');
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
        Schema::dropIfExists('productos_vendidos');
    }
}
