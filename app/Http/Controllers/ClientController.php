<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use DataTables;
class ClientController extends Controller
{
  
 public function index(Request $request)
  {

  if ($request->ajax()) {
          $data = Cliente::latest()->get();
          return Datatables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){

                         $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Editar</a>';

                         $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Eliminar</a>';

                          return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
   }
    
      return view('clientes.allClientes');
  }

  public function store(Request $request)
  {
      Cliente::updateOrCreate(['id' => $request->product_id],
              ['nombre' => $request->nombre, 'apellidos' => $request->apellidos, 
               'telefono' => $request->telefono, 'direccion' => $request->direccion]);        
 
      return response()->json(['success'=>'Product saved successfully.']);
  }

  public function edit($id)
  {
    $client = Cliente::find($id);
    return response()->json($client);
  }

  public function destroy($id)
  {
    if ($id) {
   
   
     
      return view('ventas.ventas');
   }else{
    return response()->json(['success'=>'ajskdjsakdjak.']);
   }
     
    /*
      Cliente::find($id)->delete();
   
      return response()->json(['success'=>'Product deleted successfully.']);
      */
  }

   }
   