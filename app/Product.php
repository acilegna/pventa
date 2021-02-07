<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = 
    	['codigo','descripcion','categoria',
    	 'p_compra','p_venta',
    	 'existencia','status'    	
		];
}
