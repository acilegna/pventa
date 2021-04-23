<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entradasalida extends Model
{
    protected $table = 'entradasalidas';
    protected $primaryKey = 'id_es';
    public $timestamps = false;
    protected $fillable =
    [
        'id_user', 'id_caja', 'cantidad', 'tipo', 'comentario', 'hora_fecha'
    ];
}
