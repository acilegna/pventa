<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Movimiento_caja;
use App\Movimiento_cierre;
use App\Producto_vendido;
use App\Caja;
use App\Venta;
use App\Producto;

class CajaController extends Controller{   
 	public function funcion(){

 		$alert="";   
        //guardar id de caja en una sesion
        session(['alert' => $alert]); 
        $alert = session('alert');

 	}
 	public function altaRegistroFin(Request $request){
 		 

 		$efectivoCaja= $request->efectivoFinal;	
 		$sesionUserTurno = session('id_usuTurno'); 
		$datos=$this->obtenerDatos();
		//sacar datos del arreglo
		$fechaHora=$datos[1]; 
		//consulta para comparar total en caja con efectivo al cierre
		
		$efectivo = DB::table('Movimiento_caja')->where("id_usu", "=",$sesionUserTurno)->where("status","=","abierto" )->get();
		$totalSuma=$efectivo[0]->efectivo_cierre;
		$id_Mov=$efectivo[0]->id;
		//contar total de id
		$ids= DB::table('movimientos_cierre')->where("id_mov","=",$id_Mov)->count();
	 
	 
		
		if($totalSuma==$efectivoCaja){
			//obtiene registro del  movimiento con usuario logueado y status abierto y modifica	 
	 		$Movcaja = Movimiento_caja::where("id_usu", "=",$sesionUserTurno)->where("status","=","abierto" )->update([	 		
	 	    "acomulado_ventas" =>0,
	 		"acomulado_entradas" =>0,
	 		"acomulado_salidas" =>0,
			"total_caja" =>$efectivoCaja,
			"numero_ventas" =>0,
		    "status" => "cerrado", 
	 		"termino_en" => $fechaHora]); 
		} elseif( $ids>=3){

          $this->funcion();
          

 
        
			 	 // return redirect()->back()->with('alert', 'La factura no esta guardada');
        return view('cajas.registroFinal')->with('alert', 'Mensaje no Vacio'); 

		}elseif($ids<=3){
			 
		//insertar en tabla movimientos de cierre
		$movimientos = new Movimiento_cierre;		 
		$movimientos->id_user=$sesionUserTurno;
		$movimientos->id_mov=$id_Mov;			 
 		$movimientos->fechaHora=$fechaHora; 
		$movimientos->save();
		}

 	} 

 	//funcion mostrar para registro de dinero 
	public function registroIni(){
 		return view('cajas.registroInicial'); 
 	}
 
	//funcion para dar de alta cajas
 	public function vistaCaja(){
 		return view('cajas.cajas'); 
 	}
 	//funcion para mostrar todas las cajas
 	public function allCajas(){
 		return view('cajas.allCajas'); 
 	}
 	//eliminar cajas
 	public function deleteCaja($parameters){
    	$cajas = Caja::find($parameters);
    	$cajas->delete();
    	return view('cajas.allCajas');
    }
    //guardar cambios de modifcicacion de cajas
    public function saveCangecajas(Request $request){         
    	$id = $request->inputId;
    	$cajas = Caja::find($id);
    	$cajas->descripcion = $request->inputDescripcion;
    	$cajas->status = $request->stcaja;    	  	 
    	$cajas->save();  
    }
    public function  editCajas($param){
    	$res=DB::table('cajas')->where('id',$param)->get();   
   		return view('cajas.editCajas',['res'=>$res]);
  	}
 	public function cajasAjax(Request $request){    
	    if($request->ajax())
	    {
	      $output = '';
	      $query = $request->get('query');
	      if($query != '')
	      {
	        //hace el filtro
	        $data = DB::table('cajas')
	        ->where('id', 'like', '%'.$query.'%')
	        ->orWhere('status', 'like', '%'.$query.'%')
	        ->orWhere('descripcion', 'like', '%'.$query.'%')
	        ->orderBy('id', 'desc')
	        ->get();       
	      }
	       else
	          {
	            //muestra todos los datos
	            $data = DB::table('cajas')
	             ->orderBy('id', 'desc')
	             ->get();
	          }
	      $total_row = $data->count();
	      if($total_row > 0)
	      {
	        foreach($data as $row)
	        {
	          $output .= '
	            <tr>	               
	              <td>'.$row->descripcion.'</td>
	              <td>'.$row->status.'</td>	               
	              <td>
	                <a data-toggle="tooltip" data-placement="right" title="Editar" href="./editCj/'.$row->id.'"><span class="glyphicon glyphicon-pencil borde-edit" aria-hidden="true" ></span></a>

	                <a data-toggle="tooltip" data-placement="right" title="Eliminar" href="./deleteCj/'.$row->id.'"><span class="glyphicon glyphicon-trash borde-delete" aria-hidden="true" ></span> </a>
	              </td>
	            </tr>';
	          }
	        }
	        else
	        {
	          $output = '<tr><td align="center" colspan="5">No Data Found</td></tr>';
	        }
	        $data = array(
	       'table_data'  => $output,
	       'total_data'  => $total_row);
	        echo json_encode($data);
	    }
	}

 	public function newCaja(Request $request){
 		$validate=$this->validate($request,[     
        	'inputCaja' => 'required|unique:cajas,descripcion',        	 
        	'inputStatus'=>'required|nullable'
      	]);
 		 
 		 $nameCaja=$request->inputCaja;
 		 //recoger valor seleccionado  ion
 		 //$status = $request->input('inputStatus');
 		 $status = $request->get('inputStatus');
 		 $caja = new Caja;
 		 $caja->descripcion=$nameCaja;
 		 $caja->status=$status;
 		 $caja->save();
 		 return view('panel.panel');
 	}
		 
	public function saveMovimientoscaja($id_caja,$inicial,$id_usu,$fechaHora){
		$total_venta=$this->totalVenta();
		//guardar id de usuario  usuario que continuaremos turno en una sesion
		//declarada          
        session(['id_caja' => $id_caja]); 
        $sesionId_caja= session('id_caja');  
		if ($total_venta==null){
			$total_venta=0;
		}else{
			$total_venta;
		}	
		 
		$suma=$inicial+$total_venta;
		//Para crear un registro.
		$movimientos = new Movimiento_caja;		 
		$movimientos->id_caja=$id_caja;
		$movimientos->id_usu=$id_usu;		 
		$movimientos->dinero_inicial=$inicial;
		$movimientos->acomulado_ventas= 0;
		$movimientos->acomulado_entradas=0;
		$movimientos->acomulado_salidas=0;
		$movimientos->efectivo_cierre=0;
		$movimientos->total_caja=0;
		$movimientos->numero_ventas=0;
		$movimientos->status='abierto';
		$movimientos->inicio_en=$fechaHora;
		$movimientos->termino_en=0; 
		$movimientos->save();
	}

    //cerrar caja  despues de abrir turno
	public function cerrarCaja($fechaHora,$sesionId_caja,$id_usu){	
		//obtiene registro del  movimiento con usuario logueado y status abierto y modifica	 
	 	$Movcaja = Movimiento_caja::where("id_usu", "=",$id_usu)->where("status","=","abierto" )->update([	 		
	 	    "acomulado_ventas" =>0,
	 		"acomulado_entradas" =>0,
	 		"acomulado_salidas" =>0,
			"efectivo_cierre" =>0,
			"total_caja" =>0,
			"numero_ventas" =>0,
		    "status" => "cerrado", 
	 		"termino_en" => $fechaHora]);
		//actualizar caja a disponible despues de cerrar
		//$caja = Caja::where("id",$sesionId_caja)->update(["status" => "1"]);
		//CAMBIO A POO
		 $caja = Caja::getIdSesion();
			 	 
	}
	//funcion Cerrar turno que estuvo abierto
	public function cerrarTurno($fechaHora,$sesionId_usuTurno){
 		$consultaMovcaja = Movimiento_caja::where("id_usu", "=",$sesionId_usuTurno)->where("status","=","abierto" )->get();
		foreach ($consultaMovcaja as $key => $value) {}
		$idCj=$value->id_caja; 
        $caja = Caja::where("id",$idCj)->update(["status" => "1"]);				 
		$Movcaja = Movimiento_caja::where("id_usu", "=",$sesionId_usuTurno)->where("status","=","abierto" )->update(["status" => "cerrado", "termino_en" => $fechaHora]);
 	}

  
 	public function turnoOpen(){
 		return view('cajas.turnoOpen'); 
 	}

	public function mantenerTurno(){
		$movi = Movimiento_caja::latest('id')->first();
	 			 
		$movi->acomulado_ventas= 0;
		$movi->acomulado_entradas=0;
		$movi->acomulado_salidas=0;
		$movi->efectivo_cierre=0;
		$movi->total_caja=0;
		$movi->numero_ventas=1;
		$movi->save();
	}
	//sacar el total de las ventas del ultimo registro
	public function totalVenta(){
		$venta = Venta::latest('id')->first();
        $total_venta=$venta["total"];       
        return  $total_venta;
	}
	public function obtenerDatos(){

		//id usuario logueado
		$id_user=Auth()->user()->id_employee;          
        //fecha y hora
        $time = time();
	    $fechaHora=date("d-m-Y H:i:s", $time);
        //guardar en arreglo los datos a enviar
        $datos=[$id_user,$fechaHora];
        return $datos;
	}
    public function envia(Request $request){
    	//recibir id del usuario que continuaremos turno
		$id_usuTurno=$request->Opcioncaja;
    	 
		//guardar id de usuario  usuario que continuaremos turno en una sesion
    	session(['id_usuTurno' => $id_usuTurno]);   

    	//
    	if ($request->input("cerrarTurno") == "closeTurno"){  
    		 //var_dump("hola cerrar y nuevo");
    		//usar funcion para enviar variable alert
    		 $this->funcion();
    		 //se envia vacia
    		 return view('cajas.registroFinal')->with('alert'); 

    	} else{
    		//recibir id del usuario que continuaremos turno
    		//$id_usuTurno=$request->Opcioncaja;
    	 
    		//guardar id de usuario  usuario que continuaremos turno en una sesion
        	//session(['id_usuTurno' => $id_usuTurno]);   
    		return view('panel.panel'); 
    	}

    }
    	 
	public function operacionCaja(Request $request){		  
		$datos=$this->obtenerDatos();
		//sacar datos del arreglo
		$id_usu=$datos[0];
		$fechaHora=$datos[1]; 
        //recibir dinero inicial
        $inicial=$request->inicial ;
        //recibir id de la caja que inicia sesion  
        $id_caja =$request->caja;
       
        //modificar status de caja que se elijio ponerla como inactiva
		$caja = Caja::where("id",$id_caja)->update(["status" => "0"]);        
        if ($request->input("registrar") == "regCaja"){   	      	        	       	  
        	$this->saveMovimientoscaja($id_caja,$inicial,$id_usu,$fechaHora);
        	return view('panel.panel');         	
      	} 
      	if ($request->input("cerrar") == "close"){ 
      		//id de usuario  que continuaremos turno en una sesion
      		$sesionId_usuTurno = session('id_usuTurno'); 
      		//id caja que se eligio al entrar con nuevo turno 
      		$sesionId_caja= session('id_caja');  
      		//si llega vacia la variable
      		if (empty($sesionId_usuTurno)) {
      			//var_dump(" se recibe vacias"); 
      			$this->cerrarCaja($fechaHora,$sesionId_caja,$id_usu);
      			//destruir sesion de caja
      			session()->forget('$sesionId_caja'); 
				Auth::logout();
      			return redirect('/');
      			//cerrar un turno abierto
      		}else{
      			$this->cerrarTurno($fechaHora,$sesionId_usuTurno);
				//destruir sesion de usurio turno
      			session()->forget('id_usuTurno');      		 
      			Auth::logout();
      			return redirect('/');
      		}
      	}      		 
      	   
		if ($request->input("mantener") == "open"){
 	    	$this->mantenerTurno();        	 
      		Auth::logout();
        	return redirect('/');         	 
	    }  
    }
}

 