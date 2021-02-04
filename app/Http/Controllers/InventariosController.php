<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class InventariosController extends Controller
{  
	public function viewInvent($param){
		$consulta=DB::table('productos')->where('id',$param)->get();			 
		return view('inventario.inventario',['consulta'=>$consulta]);
	}

   
}
