<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashBox extends Model
{
    protected $table = 'cajas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = ['id', 'descripcion', 'status'];

    //actualizar status al cerrar caja
    public static function updateStatusActive($sesionId_caja)
    {
        $valor = self::where("id", $sesionId_caja)->update(["status" => "1"]);
        return $valor;
    }

    public static function getQuery($query)
    {
        return self::where('id', 'like', '%' . $query . '%')
            ->orWhere('status', 'like', '%' . $query . '%')
            ->orWhere('descripcion', 'like', '%' . $query . '%')
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function getAll()
    {
        return self::orderBy('id', 'desc')->get();
    }
    public static function getBox($idCaja)
    {
        return self::where('id', $idCaja)->get();
    }
    public static function updateBoxActive($idCaja)
    {
        return self::where("id", $idCaja)->update(["status" => "1"]);
    }
    public static function updateBoxInactive($id_caja)
    {
        return self::where("id", $id_caja)->update(["status" => "0"]);
    }
    public static function  BoxActive()
    {

        return self::where('status', 1)->get();
    }
}
