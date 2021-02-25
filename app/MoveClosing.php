<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoveClosing extends Model
{
    protected $table = 'movimientos_cierre';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function setIdUserAttribute($id_user) {
        $this->attributes['id_user']= $id_user;
    }
    public function setIdMovAttribute($id_mov) {
        $this->attributes['id_mov']= $id_mov;
    }
    public function setfechaHoraAttribute($fechaHora) {
        $this->attributes['fechaHora']= $fechaHora;
    }
    /*
    public function getNameAtributes($name){
        return ucfirst($name);
    }*/
    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = 
    	['id_user','id_mov','fechaHora'];

    public static function getTotalId($id_Mov){
    	return self::where("id_mov","=",$id_Mov)->count();	
    }
}

