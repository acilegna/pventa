<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_caja extends Model
{
    protected $table = 'movimiento_caja';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = 
    	['id_caja','id_usu','dinero_inicial',
    	 'acomulado_ventas','acomulado_entradas', 'acomulado_salidas',
    	 'efectivo_cierre','total_caja','numero_ventas', 'status',
    	 'inicio_en','termino_en'];
    	 
}
