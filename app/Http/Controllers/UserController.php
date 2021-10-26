<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  //
  public function viewUsers()
  {
    return view('usuarios.usuarios');
  }

  public function allUsers(Request $request)
  {

    if ($request->ajax()) {
      $output = '';
      $query = $request->get('query');
      if ($query != '') {
        //hace el filtro

        $data = User::allUsersId($query);
      } else {
        //muestra todos los datos
        $data = User::allUsers();
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
  public function viewEdit($id)
  {

    $consultaId = User::getUsers($id);
    return view('usuarios.editUsers', compact('consultaId'));
  }
  public function viewPass()
  {
    return view('auth.passwords.email');
  }
  public function saveEditUser(Request $request)
  {
    $datos = $request->all();
    User::saveChangesUser($datos);
    //return view('usuarios.usuarios');
  }
}
