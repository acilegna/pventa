<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Psy\Test\TabCompletion\StaticSample;

class Mayoreo extends Model
{
    protected $table = 'mayoreos';
    protected $primaryKey = 'id';
    public $timestamps = true;


    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable =
    ['id_prod', 'cantidad', 'p_mayoreo'];
    public static function getMayoreoId($param)
    {
        return self::where('id_prod', $param)->get();
    }
    public static function getMayoreos()
    {
        return self::get();
    }
 
    public static function getMayoreo($param)
    {
   
        return self::join('productos', 'mayoreos.id_prod', '=', 'productos.id')		 			 
        ->select('productos.descripcion', 'productos.p_venta','mayoreos.p_mayoreo', 'mayoreos.cantidad','mayoreos.id','mayoreos.id_prod'  )
        ->where('productos.id',   $param)
        ->get();
    } 
    
    public static function Wholesale()
	{
        return self::join('productos', 'mayoreos.id_prod', '=', 'productos.id')		 			 
			->select('productos.descripcion', 'productos.p_venta','mayoreos.p_mayoreo', 'mayoreos.cantidad','mayoreos.id','mayoreos.id_prod' )
			->get();
	}
    public static function WholesaleId($query)
	{
        return self::join('productos', 'mayoreos.id_prod', '=', 'productos.id')		 			 
			->select('productos.descripcion', 'productos.p_venta','mayoreos.p_mayoreo', 'mayoreos.cantidad','mayoreos.id','mayoreos.id_prod' )
            ->where('productos.descripcion', 'like', '%' . $query . '%')
			->get();
	}
     
}
