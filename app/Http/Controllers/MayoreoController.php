<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Mayoreo;
use DB;


class MayoreoController extends Controller
{
  public function viewMayoreo()
  {
    $productos = Product::all();

    return view('mayoreo.mayoreo', compact('productos'));
  }
  public function recibeDatosmayoreo(Request $request)
  {
    //recibe datos de la vista
    $id = $request->id;
    $cantidad = $request->cantidad;
    $precio = $request->precio;

    //mete en arreglo y los manda a la funcion para insertar
    $datos = [
      'id_prod' => $id,
      'cantidad' => $cantidad,
      'p_mayoreo' => $precio
    ];
    $var = $this->validar($datos);
    if ($var == 0) {
      return redirect()->route('mayoreo')
        ->with([
          'mensaje' => 'El precio de mayoreo excede del precio de venta',
          'tipo' => 'danger'
        ]);
    } else {
      $this->saveDatosMayoreo($datos);
      return redirect()->route('mayoreo')
        ->with([
          'mensaje' => 'Registro Insertado',
          'tipo' => 'success'
        ]);
    }
  }
  public function validar($datos)
  {
    $id = $datos['id_prod'];
    $precio_mayoreo = $datos['p_mayoreo'];
    $consulta = DB::table('productos')->where('id', '=', $id)->get();
    foreach ($consulta as  $value) {
      $precio_venta = $value->p_venta;
    }
    if ($precio_mayoreo >= $precio_venta) {
      $var = 0;
      return $var;
    } else {
      $var = 1;
      return $var;
    }
  }


  public function saveDatosMayoreo($datos)
  {
    $mayoreo = new Mayoreo();
    $mayoreo->fill($datos);
    $mayoreo->save($datos);
  }

  public function llenarInput(Request $request)
  {
    if ($request->ajax()) {
      $output = '';
      $query = $request->get('query');

      if ($query != '') {
        $data = DB::table('productos')->where('id', '=', $query)->get();
      }

      if (isset($data)) {
        $total_row = $data->count();
        if ($total_row > 0) {
          foreach ($data as $row) {
            $output .= round($row->p_venta);
          }
        } else {
          $output = '<h2> Registro no encontrado en la Base de Datos</h2>';
        }
        $data = array(
          'table_datos'  => $output,
          'total_datos'  => $total_row
        );
        echo json_encode($data);
      }
    }
  }
}
