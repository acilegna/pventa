<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovePayment extends Model
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
    public static function updateAll($id_user, $fechaHora){
      

    
    return self::where("id_usu", "=",$id_user)->where("status","=","abierto" )->update([          
            "acomulado_ventas" =>0,
            "acomulado_entradas" =>0,
            "acomulado_salidas" =>0,
            "efectivo_cierre" =>0,
            "total_caja" =>0,
            "numero_ventas" =>0,
            "status" => "cerrado", 
            "termino_en" => $fechaHora]);
}
    	 
}
