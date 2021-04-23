<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovePayment extends Model
{
    protected $table = 'movimiento_caja';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function setIdCajaAttribute($id_caja)
    {
        $this->attributes['id_caja'] = $id_caja;
    }
    public function setIdUsuAttribute($id_usu)
    {
        $this->attributes['id_usu'] = $id_usu;
    }
    public function setDineroInicialAttribute($inicial)
    {
        $this->attributes['dinero_inicial'] = $inicial;
    }
    public function setInicioEnAttribute($fechaHora)
    {
        $this->attributes['inicio_en'] = $fechaHora;
    }
    public function setStatusAttribute($status)
    {
        $this->attributes['status'] = ucfirst($status);
    }


    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable =
    [
        'id_caja', 'id_usu', 'dinero_inicial',
        'acomulado_ventas', 'acomulado_entradas', 'acomulado_salidas',
        'efectivo_cierre', 'total_caja', 'numero_ventas', 'status',
        'inicio_en', 'termino_en'
    ];

    public static function updateAll($id_user, $fechaHora)
    {
        return self::where("id_usu", "=", $id_user)->where("status", "=", "Abierto")->update([
            "acomulado_ventas" => 0,
            "acomulado_entradas" => 0,
            "acomulado_salidas" => 0,
            "efectivo_cierre" => 0,
            "total_caja" => 0,
            "numero_ventas" => 0,
            "status" => "cerrado",
            "termino_en" => $fechaHora
        ]);
    }
    //obtener datos de la sesion abierta
    public static function getTurnoOpen($sesionUserTurno)
    {
        return self::where("id_usu", "=", $sesionUserTurno)->where("status", "=", "Abierto")->get();
    }

    public static function updateTurnoOpen($sesionUserTurno, $efectivoCaja, $fechaHora)
    {
        return self::where("id_usu", "=", $sesionUserTurno)->where("status", "=", "Abierto")->update([
            "acomulado_ventas" => 0,
            "acomulado_entradas" => 0,
            "acomulado_salidas" => 0,
            "total_caja" => $efectivoCaja,
            "numero_ventas" => 0,
            "status" => "cerrado",
            "termino_en" => $fechaHora
        ]);
    }

    public static function turnOpen()
    {
        return self::join('users', 'users.id_employee', '=', 'movimiento_caja.id_usu')
            ->join('cajas', 'cajas.id', '=', 'movimiento_caja.id_caja')
            ->select(
                'cajas.descripcion',
                'users.firstname',
                'movimiento_caja.id',
                'movimiento_caja.id_usu',
                'movimiento_caja.id_caja',
                'movimiento_caja.acomulado_entradas',
                'movimiento_caja.acomulado_salidas',
                'movimiento_caja.acomulado_ventas'

            )
            ->where('movimiento_caja.status', '=', 'Abierto')
            ->get();
    }
}
