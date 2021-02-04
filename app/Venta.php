<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = 
    	['total','fecha'];
}
