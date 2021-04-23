<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CashBox;
use App\MovePayment;

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
    public function index(Request $request)
    {
        //obtener turnos abiertos      
        $resOpen = MovePayment::turnOpen();
        //Verificar si la consulta arroja resultados
        $i = count($resOpen);
        //consultar cajas disponibles
        $cajaClose = CashBox::BoxActive();
        switch (true) {
                //si no hay sesiones abiertas
            case $i == '0':
                return view('cajas.registroInicial')->with('cajaClose', $cajaClose);
                break;
                //si hay sesiones abiertas
            case $i >= '1':
                $cantidad = count($resOpen);
                $datoTurno = array($resOpen, $cantidad);
                foreach ($datoTurno[0] as $res) {
                }

                return view('cajas.turnoOpen')->with('datoTurno', $datoTurno);

                break;
        }
    }
    public function welcome()
    {
        return view('panel.panel');
    }
}
