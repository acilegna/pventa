<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CashBox;
use App\MovePayment;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*permitir que usuarios autenticados accedan a una ruta determinada
        si estan autenticados redirecciona a home*/
         $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request )
    {
        //sacar id usuario logueado
        
        $user = \Auth::user();
        $id_user= $user->id_employee;  


        //obtener turnos abiertos      
        $resOpen = DB::table('movimiento_caja')
            ->join('users', 'users.id_employee', '=', 'movimiento_caja.id_usu')    
            ->join('cajas', 'cajas.id', '=', 'movimiento_caja.id_caja') 
                                     
            ->select('cajas.descripcion','users.firstname','movimiento_caja.id_usu')
            ->where ('movimiento_caja.status','=',"abierto")
            ->get();
        //Verificar si la consulta arroja resultados
        $i=count($resOpen);
        //consultar cajas disponibles
        $cajaClose= CashBox::where("status",1)->get();    
        switch (true) {
        //si no hay sesiones abiertas
        case $i=='0':
            return view('cajas.registroInicial')->with('cajaClose', $cajaClose);
            break;
        //si hay sesiones abiertas
        case $i >='1':
                $cantidad=count($resOpen);
                $datoTurno=array($resOpen,$cantidad);
                //var_dump($datoTurno[1]);

                foreach($datoTurno[0] as $res){
               // var_dump($res->firstname);
        }
              
                return view('cajas.turnoOpen')->with('datoTurno', $datoTurno);
                
            break; 
        } 
         
    }
    public function welcome( ){
    /*
      if ($request->input("logins") == "log"){
        var_dump("expression");
      } */
        
         //return view('home');}
        return view('panel.panel');
    }
      
}
