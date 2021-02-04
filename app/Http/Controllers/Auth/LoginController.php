<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Caja;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {        
        $this->middleware('guest')->except('logout');
        /*
        //recibir id de la caja que inicia sesion
        $id_caja=$request->caja;   
        //guardar id de caja en una sesion
        session(['id_caja' => $id_caja]);       
        //modificar status de caja que se elijio ponerla como inactiva
        $caja = Caja::where("id",$id_caja)->update(["status" => "0"]); 
        */       
    }
}
