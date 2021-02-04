<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mayoreo extends Model
{   
	protected $table = 'mayoreos';   
    protected $primaryKey = 'id';
    public $timestamps = true;


    //lista blanca atributos que deberían ser asignables en masa
    protected $fillable = 
    	['id_prod','cantidad','p_mayoreo'];
}
