<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Venta;
use App\Producto;
use DB;
use Mpdf\Mpdf;
//use DataTables;
class ReportController extends Controller
{
	public function ViewReportes(){
		//enviar usuarios a la vista
  		return view("Reportes.reporteVentas",["usuarios" => User::all(),]);
	}
	//funcion axaj para las busquedas
	public function reporte(Request $request){
		if($request->ajax()){
			$output = '';
			$date1 = $request->get('date1');   
			$date2 = $request->get('date2'); 
			$user =  $request->get('sale_by'); 

			$date3='2020-09-01';
			$date4='2020-09-23';

		  	if($date1 != ''and $date2 != '' and $user !=''){	  	  
			  	$data = DB::table('productos_vendidos')
			      ->join('users', 'users.id_employee', '=', 'productos_vendidos.id_user')    
			      ->join('ventas', 'ventas.id', '=', 'productos_vendidos.id_venta') 
			      ->join('productos', 'productos.id', '=', 'productos_vendidos.id_producto')                   
			      ->select('ventas.id', 'ventas.fecha','users.firstname','productos.p_venta','productos_vendidos.cantidad','ventas.total','productos.descripcion')
			      ->where ('users.id_employee','=',$user)
			      ->whereBetween('ventas.fecha',[$date1,$date2])
			      ->get();
		  	}    
		  	if($date1 != ''and $date2 != '' and $user =='all'){	  	  
			  	$data = DB::table('productos_vendidos')
			      ->join('users', 'users.id_employee', '=', 'productos_vendidos.id_user')    
			      ->join('ventas', 'ventas.id', '=', 'productos_vendidos.id_venta') 
			      ->join('productos', 'productos.id', '=', 'productos_vendidos.id_producto')                   
			      ->select('ventas.id', 'ventas.fecha','users.firstname','productos.p_venta','productos_vendidos.cantidad','ventas.total','productos.descripcion')			       
			      ->whereBetween('ventas.fecha',[$date1,$date2])
			      ->get();
		  	}    
		   	if (isset($data)){  	   
		    	$total_row = $data->count();
		      	if($total_row > 0)
		      	{
		        	foreach($data as $row)
		        	{
			        	$output .= '
			            <tr>
			              <td>'.$row->id.'</td>
			              <td>'.$row->fecha.'</td>
			              <td>'.$row->firstname.'</td>
			              <td>'.$row->p_venta.'</td>  
			              <td>'.$row->cantidad.'</td>   
			              <td>'.$row->total.'</td> 
			              <td>'.$row->descripcion.'</td>            
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
	}

	public function getGenerar(Request $request){  
    	//RECIBE todos los datos
    	//$datos = $request->all();
    	//RECIBE individualmente
		  $date1 = $request->datepicker; 
		  $date2 = $request->datepicker_2;
		  $user = $request->sale_by;

    	if($date1 != ''and $date2 != '' and $user != ''){	  	  	  
		  	$datos = DB::table('productos_vendidos')
		      ->join('users', 'users.id_employee', '=', 'productos_vendidos.id_user')    
		      ->join('ventas', 'ventas.id', '=', 'productos_vendidos.id_venta') 
		      ->join('productos', 'productos.id', '=', 'productos_vendidos.id_producto')                   
		      ->select('ventas.id', 'ventas.fecha','users.firstname','productos.p_venta','productos_vendidos.cantidad','ventas.total','productos.descripcion')
		      ->where ('users.id_employee','=',$user)
		      ->whereBetween('ventas.fecha',[$date1,$date2])
		      ->get();	       
		} 
		if($date1 != ''and $date2 != '' and $user =='all'){	  	  	  
		  	$datos = DB::table('productos_vendidos')
		      ->join('users', 'users.id_employee', '=', 'productos_vendidos.id_user')    
		      ->join('ventas', 'ventas.id', '=', 'productos_vendidos.id_venta') 
		      ->join('productos', 'productos.id', '=', 'productos_vendidos.id_producto')                   
		      ->select('ventas.id', 'ventas.fecha','users.firstname','productos.p_venta','productos_vendidos.cantidad','ventas.total','productos.descripcion')		      
		      ->whereBetween('ventas.fecha',[$date1,$date2])
		      ->get();	       
		}  

		$fechas=array($date1,$date2);

		if($user =='opc'){
			var_dump('elige usuario');
		}
		else{
    		return $this->Pdf($datos,$fechas);
        }
    }

  
    public function Pdf($datos,$fechas){
    	//$total_row = $datos->count();
 		 
    	$fecha_1=$fechas[0];
    	$fecha_2=$fechas[1];
    	$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];
 
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = new Mpdf([
            'fontDir' => array_merge($fontDirs, [
                public_path() . '/fonts',
            ]),
            'fontdata' => $fontData + [
                'arial' => [
                    'R' => 'arial.ttf',                     
                ],
            ],
            'default_font' => 'arial',
            // "format" => "A4",
            "format" => [264.8,188.9],
        ]);
        $mpdf->SetDisplayMode('fullpage');   
    	 
		$mpdf=new Mpdf();
        $mpdf->WriteHTML(view('Reportes.plantilla')->with("datos",$datos)->render());
        $namefile = 'Report_venta_del '.$fecha_1.' al '.$fecha_2.'.pdf';
        $mpdf->Output($namefile,"I");
    }	 
}
