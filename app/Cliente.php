<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
     protected $table = 'clientes';
     protected $primaryKey = 'id';
     public $timestamps = true;
     protected $fillable =
     [
          'nombre', 'apellidos', 'telefono',
          'direccion'
     ];

     public static $rules = [
          'nombre' => 'required|string',
          'apellidos' => 'required|string',
          'telefono' => 'required|numeric',
          'direccion' => 'required'

     ];
}
