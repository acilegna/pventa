<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use DataTables;

class ClientController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {


    if ($request->ajax()) {



      $data = Cliente::latest()->get();
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('btn', 'clientes.actions')
        ->rawColumns(['btn'])
        ->make(true);
    }

    return view('clientes.allClientes');
  }


  public function store(Request $request)

  {

    $request->validate(Cliente::$rules);


    $result = Cliente::updateOrCreate(
      ['id' => $request->product_id],
      [
        'nombre' => $request->nombre, 'apellidos' => $request->apellidos,
        'telefono' => $request->telefono, 'direccion' => $request->direccion
      ]
    );


    $arr = array('msg' => 'El registro ha sido modificado!', 'status' => true);

    return Response()->json($arr);
  }

  public function edit($id)
  {
    $client = Cliente::find($id);
    return response()->json($client);
  }

  public function destroy($id)
  {

    if ($id != null) {
      Cliente::find($id)->delete();
      $arr = array('msg' => 'Registro eliminado!', 'status' => true);
    } else {
      $arr = array('msg' => 'Datos no recibidos', 'status' => true);
    }
    return Response()->json($arr);
  }
}
