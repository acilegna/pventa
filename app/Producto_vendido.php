<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_vendido extends Model
{
	protected $table = 'productos_vendidos';
	protected $primaryKey = 'id';
	public $timestamps = true;

	//lista blanca atributos que deberían ser asignables en masa
	protected $fillable = 
		['id_venta', 'id_cliente','id_producto','descripcion','precio','cantidad'   	
		];
}
