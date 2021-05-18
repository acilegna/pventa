<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SellProduct;
use Mpdf\Mpdf;

class ReportController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function ViewReportes()
	{
		//enviar usuarios a la vista
		return view("Reportes.reporteVentas", ["usuarios" => User::all(),]);
	}
	//funcion axaj para las busquedas
	public function reporte(Request $request)
	{
		if ($request->ajax()) {
			$output = '';
			$date1 = $request->get('date1');
			$date2 = $request->get('date2');
			$user =  $request->get('sale_by');


			if ($date1 != '' and $date2 != '' and $user != '') {
				$data = SellProduct::sellProductByUser($user, $date1, $date2);
			}
			if ($date1 != '' and $date2 != '' and $user == 'all') {
				$data = SellProduct::sellProducts($date1, $date2);
			}
			if (isset($data)) {
				$total_row = $data->count();
				if ($total_row > 0) {
					$output = $data;
				} else {
					$output = ['No se encuentran  registros'];
				}
				$data = array(
					'table_data'  => $output,
					'total_data'  => $total_row
				);
				echo json_encode($data);
			}
		}
	}

	public function getGenerar(Request $request)
	{
		//RECIBE todos los datos
		//$datos = $request->all();
		//RECIBE individualmente
		$date1 = $request->datepicker;
		$date2 = $request->datepicker_2;
		$user = $request->sale_by;

		if ($date1 != '' and $date2 != '' and $user != '') {
			$datos = SellProduct::sellProductByUser($user, $date1, $date2);
		}
		if ($date1 != '' and $date2 != '' and $user == 'all') {
			$datos = SellProduct::sellProducts($date1, $date2);
		}

		$fechas = array($date1, $date2);

		if ($user == 'opc') {
			var_dump('elige usuario');
		} else {
			return $this->Pdf($datos, $fechas);
		}
	}


	public function Pdf($datos, $fechas)
	{

		$fecha_1 = $fechas[0];
		$fecha_2 = $fechas[1];
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
					'R' => 'FreeSerif.ttf',
				],
			],
			'default_font' => 'FreeSerif',
			// "format" => "A4",
			"format" => [264.8, 188.9],
		]);
		$mpdf->SetDisplayMode('fullpage');

		$mpdf = new Mpdf();
		$mpdf->WriteHTML(view('Reportes.plantilla')->with("datos", $datos)->render());
		$namefile = 'Report_venta_del ' . $fecha_1 . ' al ' . $fecha_2 . '.pdf';
		$mpdf->Output($namefile, "I");
	}
}
