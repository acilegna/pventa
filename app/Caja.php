<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $table = 'cajas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = ['id_user','descripcion','status'];

    //METODO ORIENTADO A OBJETO
   	public static function getIdSesion($sesionId_caja){
		return self::where("id",$sesionId_caja)->update(["status" => "1"]);
	}

    	
	 
}
