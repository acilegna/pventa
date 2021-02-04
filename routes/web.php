<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Caja;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {

	return view('auth.login');


	/*
	//seleccionar las cajas que hayan quedado abiertas
	$resZero= Caja::where("status",0)->get();
	//seleccionar las cajas que esten desocupadas
	$res= Caja::where("status",1)->get();	 
	$resZ=count($resZero);
	if($resZ>0){
	 	//var_dump("hay turno abierto");
	 	return view('cajas.turnoOpen');
	} elseif ($resZ<=0) {
		return view('auth.login')->with('res', $res);
	}
	*/

});
Route::get('/welcome', 'HomeController@welcome')->name('welcome'); 
//CAJA
Route::post('/envia', 'CajaController@envia')->name('envia');
//Route::post('/inicial', 'CajaController@saveCaja')->name('inicial');
Route::post('/caja', 'CajaController@operacionCaja')->name('caja');
Route::get('/viewcaja', 'CajaController@vistaCaja')->name('viewcaja');
Route::post('/newcaja', 'CajaController@newCaja')->name('newcaja');
Route::get('/allcaja', 'CajaController@allCajas')->name('allcaja');
Route::get('/cajasAjax', 'CajaController@cajasAjax')->name('cajasAjax');
Route::get('/deleteCj/{id}', 'CajaController@deleteCaja')->name('deleteCj');
Route::get('/editCj/{id}', 'CajaController@editCajas')->name('editCj');
Route::post('/saveC', 'CajaController@saveCangecajas')->name('saveC');
Route::get('/regInicial', 'CajaController@registroIni')->name('regInicial');
 
Route::get('/turnoOpen', 'CajaController@turnoOpen')->name('turnoOpen');
Route::post('/verificar', 'CajaController@altaRegistroFin')->name('verificar');
 
 
 
//PRODUCTOS
Route::post('/save', 'ProductosController@saveNewProduct')->name('save');
Route::get('/productos', 'ProductosController@all')->name('productos');
Route::get('/altaProd', 'ProductosController@altaProductos')->name('altaProd');
Route::post('/saveChang', 'ProductosController@saveCambios')->name('savecChang');
Route::get('/editProd/{id}', 'ProductosController@editProductos')->name('editProd');
Route::get('/action', 'ProductosController@action')->name('action');
Route::get('/viewFiltro', 'ProductosController@viewFiltro')->name('viewFiltro');
Route::get('/deletePr/{id}', 'ProductosController@deleteProd')->name('deletePr');

// INVENTARIOS
Route::get('/viewInv/{id}', 'InventariosController@viewInvent')->name('viewInv');

// VENTAS

Route::get('/viewVents', 'VentasController@viewVentas')->name('viewVents'); 
Route::post("/buscarProducto", "VentasController@buscarProducto")->name("buscarProducto");

Route::post("/terminarOCancelarVenta", "VentasController@terminarOCancelarVenta")->name("terminarOCancelarVenta");
Route::post('/agregaCantidad', 'VentasController@agregarCantidadProducto')->name('agregaCantidad'); 
Route::post('/addDelete', 'VentasController@agregarOEliminarCantidadProducto')->name('addDelete');

Route::get('/producto', 'VentasController@producto')->name('producto');
Route::get('/verifica', 'VentasController@verificaPrecio')->name('verifica');
Route::get('/agrega', 'VentasController@agregaVarios')->name('agrega');
Route::get('/cobrar', 'VentasController@cobrar')->name('cobrar');
Route::get('/cobrar', 'VentasController@cobrar')->name('cobrar');
 

//MAYOREO
Route::get('/mayoreo', 'MayoreoController@viewMayoreo')->name('mayoreo');
Route::post('/recibe','MayoreoController@recibeDatosmayoreo')->name('recibe');
Route::get('/llenar', 'MayoreoController@llenarInput')->name('llenar');


//CLIENTES
Route::get('/viewFiltroC', 'ClienteController@viewFiltro')->name('viewFiltroC');
Route::get('/ver', 'ClienteController@ver')->name('ver');
Route::get('/actionC', 'ClienteController@action')->name('actionC');
Route::get('viewFiltroC/{cli_id?}', 'ClienteController@show');
Route::put('viewFiltroC/{cli_id}', 'ClienteController@update');
Route::post('viewFiltroC', 'ClienteController@store');
Route::resource('client','ClientController');
 
// REPORTES
Route::get('/viewReportes', 'ReportController@ViewReportes')->name('viewReportes');
Route::get('/reporte','ReportController@reporte')->name('reporte');
Route::post('/pdfs','ReportController@getGenerar')->name('pdfs');


Route::get('pdf','PdfController@getIndex');
Route::get('pdf/generar','PdfController@getGenerar');

 