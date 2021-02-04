<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';
    protected $primaryKey = 'id';
    public $timestamps = true;
    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = 
    	['descripcion','cantidad_inicial',
    	 'cantidad','costo_unitario','costo_despues'    	
		];

}
