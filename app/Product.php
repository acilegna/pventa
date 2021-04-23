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
    [
        'codigo', 'descripcion', 'categoria',
        'p_compra', 'p_venta',
        'existencia', 'status'
    ];

    public static function getProducts($param)
    {
        return self::where('id', $param)->get();
    }

    public static function searchProduct($query)
    {
        return self::where('id', 'like', '%' . $query . '%')
            ->orWhere('codigo', 'like', '%' . $query . '%')
            ->orWhere('descripcion', 'like', '%' . $query . '%')
            ->orderBy('id', 'desc')
            ->get();
    }
    public static function searchAllProduct()
    {
        return self::orderBy('id', 'desc')
            ->get();
    }
    public static function searchEditProduct($param)
    {
        return self::where('id', $param)->get();
    }
    public static function searchByCodigo($query)
    {
        return self::where("codigo", "=", $query)->get();
    }
}
