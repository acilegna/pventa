<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class InventariosController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function viewInvent($param)
	{

		$consulta = Product::getProducts($param);
		return view('inventario.inventario', ['consulta' => $consulta]);
	}
}
