<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entradasalida;
use App\MovePayment;
use Illuminate\Support\Arr;


class EntradaSalidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewEntrada()
    {
        return view('entradas.entradas');
    }
    public function saveEntradaSalida($data)
    {
        Entradasalida::create($data);
    }
    public function updatemovePayment($datosMovepayment)
    {


        $id = $datosMovepayment[0];
        $entradaSalida = $datosMovepayment[1];
        $option = $datosMovepayment[2];
        $acomulado_salidas = $datosMovepayment[3];
        $acomulado_entradas = $datosMovepayment[4];
        $acomulado_salidas += $entradaSalida;
        $acomulado_entradas += $entradaSalida;


        $move = MovePayment::find($id);
        if ($option == 1) {
            $move->acomulado_salidas = $acomulado_salidas;
            $move->save();
        } else {
            $move->acomulado_entradas =  $acomulado_entradas;
            $move->save();
        }
    }


    public function saveMovimientos(Request $request)

    {

        $user = \Auth::user();
        $id_log = $user->id_employee;
        $res = MovePayment::turnOpen();
        $idCaja = $res[0]->id_caja;
        $id = $res[0]->id;
        $acomulado_salidas = $res[0]->acomulado_salidas;
        $acomulado_entradas = $res[0]->acomulado_entradas;
        $entradaSalida = $request->cantidadEntrada;
        $comentario = $request->comentario;
        $tipo = 'entrada';
        //fecha y hora
        $time = time();
        $fechaHora = date('d-m-Y H:i:s', $time);
        $option = 0;
        $data = [
            'id_user' => $id_log,
            'id_caja' => $idCaja,
            'cantidad' => $entradaSalida,
            'tipo' => $tipo,
            'comentario' => $comentario,
            'hora_fecha' => $fechaHora,
        ];
        $datosMovepayment = [$id, $entradaSalida, $option, $acomulado_salidas, $acomulado_entradas];

        if ($request->input('saveEntrada') == 'entrada') {
            //saveentradasalida
            $this->saveEntradaSalida($data);
            //updatemovepayment
            $this->updatemovePayment($datosMovepayment);
            return redirect('/welcome');
        } elseif ($request->input('saveSalida') == 'salida') {
            $option = 1;
            $reemplaza_tipo = array('tipo' => 'salida');
            $data = array_replace($data, $reemplaza_tipo);

            //array reemplaza
            $reemplaza_salida = array(2 => $option);
            $datos = array_replace($datosMovepayment, $reemplaza_salida);

            $this->saveEntradaSalida($data);
            //updateMovePayment
            $this->updatemovePayment($datos);
            return redirect('/welcome');
        }
    }
}
