<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellProduct extends Model
{
	protected $table = 'productos_vendidos';
	protected $primaryKey = 'id';
	public $timestamps = true;

	//lista blanca atributos que deberían ser asignables en masa
	protected $fillable =
	[
		'id_venta', 'id_user', 'id_producto', 'descripcion', 'precio', 'cantidad'
	];

	public static function sellProductByUser($user, $date1, $date2)
	{
		return self::join('users', 'users.id_employee', '=', 'productos_vendidos.id_user')
			->join('ventas', 'ventas.id', '=', 'productos_vendidos.id_venta')
			->join('productos', 'productos.id', '=', 'productos_vendidos.id_producto')
			->select('ventas.id', 'ventas.fecha', 'users.firstname', 'productos.p_venta', 'productos_vendidos.cantidad', 'ventas.total', 'productos.descripcion')
			->where('users.id_employee', '=', $user)
			->whereBetween('ventas.fecha', [$date1, $date2])
			->get();
	}
	public static function sellProducts($date1, $date2)
	{
		return self::join('users', 'users.id_employee', '=', 'productos_vendidos.id_user')
			->join('ventas', 'ventas.id', '=', 'productos_vendidos.id_venta')
			->join('productos', 'productos.id', '=', 'productos_vendidos.id_producto')
			->select('ventas.id', 'ventas.fecha', 'users.firstname', 'productos.p_venta', 'productos_vendidos.cantidad', 'ventas.total', 'productos.descripcion')
			->whereBetween('ventas.fecha', [$date1, $date2])
			->get();
	}
}
