<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntradasController extends Controller
{
    public function viewEntrada(){
        return view('entradas.entradas');
    }
}
