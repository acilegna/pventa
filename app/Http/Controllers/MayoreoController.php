<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Mayoreo;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class MayoreoController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function viewEditmayoreo($id)
  {

    $consulta = Mayoreo::getMayoreo($id);
    return view('mayoreo.editMayoreo', ['consulta' => $consulta]);
  }
 
  public function deleteMayoreo($id){
     
    $mayoreo = Mayoreo::find($id);
    $mayoreo->delete();
    return redirect()->route('mayoreo')
      ->with([
        'mensaje' => 'E3 reg5str6 ha s5d6 e3505nad6',
        'tipo' => 'danger'
      ]);
   
  }
  public function recibeMayoreo(Request $request)
  {
    //id producto
    $id = $request->id;
    $idM= $request->idM;
    $cantidad = $request->cantidad;
    //precio Mayoreo
    $precio = $request->precio;
    // var_dump($precio);
 
    //guardar en arreglo 
    $datos = [
      'id' => $idM,
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
    }else{
      $this->saveChangeMayoreos($datos);
      return redirect()->route('mayoreo')
        ->with([
          'mensaje' => 'Registro Modificado',
          'tipo' => 'success'
        ]);
    }
 
  }

  public function saveChangeMayoreos($datos)
  {

    $idMayoreo = $datos['id'];  
    $mayoreo = Mayoreo::find($idMayoreo);     

    //modificar tabla productos    
    $mayoreo->cantidad = $datos['cantidad'];
    $mayoreo->p_mayoreo = $datos['p_mayoreo'];
    $mayoreo->save(); 
    
  }

  public function allmayoreo(Request $request)
  {

    if ($request->ajax()) {
      $output = '';
      $query = $request->get('query');
      if ($query != '') {
        //hace el filtro

        $data = Mayoreo::WholesaleId($query);
      } else {
        //muestra todos los datos
        $data = Mayoreo::Wholesale();
      }
      $total_row = $data->count();
      if ($total_row > 0) {
        $output = $data;
      } else {
        $output = ["No hay registros"];
      }
      $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row
      );
      echo json_encode($data);
    }
  }
  public function newmayoreo()
  {
    // $mayoreoP = Mayoreo::Wholesale();
    //return view('mayoreo.mayoreo', compact('mayoreoP'));
    $productos = Product::all();

    return view('mayoreo.mayoreo', compact('productos'));
  }

  public function viewMayoreo()
  {

    return view('mayoreo.mayoreos');
  }
  public function recibeDatosmayoreo(Request $request)
  {
    //recibe datos de la vista
    $id = $request->id;
    $cantidad = $request->cantidad;
    $precio = $request->precio;


    //guardar en arreglo 
    $datos = [
      'id_prod' => $id,
      'cantidad' => $cantidad,
      'p_mayoreo' => $precio
    ];

    $var = $this->validar($datos);
    $id_productoMayoreo = $this->verificaMayoreos($datos);

    if ($id_productoMayoreo == $id) {

      return redirect()->route('newM')
        ->with([
          'mensaje' => 'Ese producto ya tiene mayoreo',
          'tipo' => 'danger'
        ]);
    }

    if ($var == 0) {
      return redirect()->route('newM')
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
  public function verificaMayoreos($datos)
  {
    $id = $datos['id_prod'];
    $mayoreo = Mayoreo::getMayoreoId($id);

    if (count($mayoreo) != 0) {
      $id_productoMayoreo = $mayoreo[0]->id_prod;
      return $id_productoMayoreo;
    } else {
      $id_productoMayoreo = "";
      return $id_productoMayoreo;
    }
  }
  public function validar($datos)
  {
    $id = $datos['id_prod'];
    $precio_mayoreo = $datos['p_mayoreo'];

    $consulta = Product::getProducts($id);

    $precio_venta = $consulta[0]->p_venta;



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

        $data = Product::getProducts($query);
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
