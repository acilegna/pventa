<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoveClosing extends Model
{
    protected $table = 'movimientos_cierre';
    protected $primaryKey = 'id';
    public $timestamps = false;

    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = 
    	['id_user','id_mov','fechaHora'];
}

