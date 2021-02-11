<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\MovePayment;
use App\MoveClosing; 
use App\CashBox;
use App\Sell;

class CajaController extends Controller{  

 	public function funcion(){
 		$alert="";   
        //guardar id de caja en una sesion
        session(['alert' => $alert]); 
        $alert = session('alert');
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
    	$cajas = CashBox::find($parameters);
    	$cajas->delete();
    	return view('cajas.allCajas');
    }
    //guardar cambios de modificacion de cajas
    public function saveCangecajas(Request $request){         
    	$id = $request->inputId;
    	$cajas = CashBox::find($id);
    	$cajas->descripcion = $request->inputDescripcion;
    	$cajas->status = $request->stcaja;    	  	 
    	$cajas->save();  
    }
    public function  editCajas($param){

    	$res=  CashBox::getBox($param);   
   		return view('cajas.editCajas',['res'=>$res]);
   		 
  	}
 	public function cajasAjax(Request $request){    
	    if($request->ajax())	    {
	    	$output = '';

	      	$query = $request->get('query');
	      	if($query != '')
	      	{
	        	//hace el filtro
	        	$data = CashBox::getQuery($query);       
	      	}
	       	else
	        {
	            //muestra todos los datos
	            $data = CashBox::getAll();
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
 		 $caja = new CashBox;
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
		$movimientos = new MovePayment;		 
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

    
  
 	public function turnoOpen(){
 		return view('cajas.turnoOpen'); 
 	}

	//sacar el total de las ventas del ultimo registro
	public function totalVenta(){
		$venta = Sell::latest('id')->first();
        $total_venta=$venta["total"];       
        return  $total_venta;
	}
	// Obtener usuario logueado y fechaHora
	public function obtenerDatos(){
		//id usuario logueado
		$id_user=Auth()->user()->id_employee;          
        //fecha y hora
        $time = time();
	    $fechaHora=date("d-m-Y H:i:s", $time);
        //almacenar en arreglo los datos a enviar
        $datos=[$id_user,$fechaHora];
        return $datos;
	}
	
	public function altaRegistroFin(Request $request){ 		 
 		$efectivoCaja= $request->efectivoFinal;	
 		$sesionUserTurno = session('id_usuTurno'); 
		$datos=$this->obtenerDatos();

		//sacar datos del arreglo
		$fechaHora=$datos[1]; 
		//consulta para comparar total en caja con efectivo al cierre
		$efectivo=MovePayment::getTurnoOpen($sesionUserTurno);

		$totalSuma=$efectivo[0]->efectivo_cierre;
		$id_Mov=$efectivo[0]->id;
		//contar total de id, si hay mas de 3 bloquear pantalla y solicitar contraseña al admin		 
	 	$ids=MoveClosing::getTotalId($id_Mov);
		
		//compara efectivo fisico en caja con el total en la bd
		if($totalSuma==$efectivoCaja){

			$consultaMovcaja = MovePayment::getTurnoOpen($sesionUserTurno); 	
			foreach ($consultaMovcaja as $key => $value) {}
			$idCaja=$value->id_caja; 
        	$caja = CashBox::updateBoxActive($idCaja);
			//obtiene registro del  movimiento con usuario logueado y status abierto y modifica	 
			$Movcaja= MovePayment::updateTurnoOpen($sesionUserTurno, $efectivoCaja, $fechaHora);
			//destruir sesion
			session()->forget('id_usuTurno'); 
			Auth::logout();
      		return redirect('/'); 

		} elseif( $ids>=3){
			// si hay 3 registros con el mismo id regresar ventana para solicitar al admin el desbloqueo
			return view('cajas.registroFinal')->with('alert', 'Mensaje no Vacio'); 

		}elseif($ids<=3){			 
			//insertar en la bd los movimientos de cierre
			$movimientos = new MoveClosing;		 
			$movimientos->id_user=$sesionUserTurno;
			$movimientos->id_mov=$id_Mov;			 
	 		$movimientos->fechaHora=$fechaHora; 
			$movimientos->save();
		}

 	} //fin metodo

    public function envia(Request $request){
    	//recibir id del usuario que continuaremos turno
		$id_usuTurno=$request->Opcioncaja;  
		$sesionId_usuTurno = session('id_usuTurno');   	 
		//guardar id de usuario  usuario que continuaremos turno en una sesion
    	session(['id_usuTurno' => $id_usuTurno]);   

    	//
    	if ($request->input("cerrarTurno") == "closeTurno"){  
    		 
    		//usar funcion para enviar variable alert
    		 $this->funcion();
    		 //se envia vacia
    		 return view('cajas.registroFinal')->with('alert'); 

    	} else{
    		
    		return view('panel.panel'); 
    	}

    }
    public function mantenerTurno(){
		$movi = MovePayment::latest('id')->first();	 			 
		$movi->acomulado_ventas= 0;
		$movi->acomulado_entradas=0;
		$movi->acomulado_salidas=0;
		$movi->efectivo_cierre=0;
		$movi->total_caja=0;
		$movi->numero_ventas=1;
		$movi->save();
	}

    //cerrar caja  despues de abrir turno
	public function cerrarCaja($fechaHora, $sesionId_caja, $id_usu){
		
	 	
		//obtiene registro del  movimiento con usuario logueado y status abierto  
	 	$Movcaja=MovePayment::updateAll($id_usu,$fechaHora);
		//actualizar caja a disponible despues de cerrar	
		$caja = CashBox::updateStatusActive($sesionId_caja);
		  	 
	}
	//funcion Cerrar turno que estuvo abierto
	public function cerrarTurno($fechaHora,$sesionId_usuTurno){
		
	 	//obtener datos con sttaus abierto	  		
 	    $consultaMovcaja = MovePayment::getTurnoOpen($sesionId_usuTurno); 
		foreach ($consultaMovcaja as $key => $value) {}
		$idCaja=$value->id_caja; 
        $caja = CashBox::updateBoxActive($idCaja);		
		$Movcaja= MovePayment::updateTurnoOpen($sesionUserTurno, $efectivoCaja=0, $fechaHora);
	
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
        //modificar status de caja  ponerla  inactiva
		$caja = CashBox::updateBoxInactive($id_caja);        
        if ($request->input("registrar") == "regCaja"){   	      	        	       	  
        	$this->saveMovimientoscaja($id_caja,$inicial,$id_usu,$fechaHora);
        	return view('panel.panel');         	
      	} 
      	if ($request->input("cerrar") == "close"){
      		 
      		//id de usuario  que continuaremos turno en una sesion
      		$sesionId_usuTurno = session('id_usuTurno'); 
      		//id caja que se eligio al entrar con nuevo turno 
      		$sesionId_caja= session('id_caja');  

      		//si llega vacia la variable. Cerrar caja normal
      		if (empty($sesionId_usuTurno)) {
      		 
      			$this->cerrarCaja($fechaHora,$sesionId_caja,$id_usu);
      			//destruir sesion de caja
      			session()->forget('$sesionId_caja'); 
				Auth::logout();
      			return redirect('/'); 
      			 
      			//cerrar caja, cuando se quedo un turno abierto
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

 