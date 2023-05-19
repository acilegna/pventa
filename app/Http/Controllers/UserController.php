<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  //
  public function viewUsers()
  {
    return view('usuarios.usuarios');
  }
  public function viewAdduser()
  {
    return view('usuarios.addusers');
  }
  public function addUser(Request $request)
  {
    /*     $recibeDatos = $request->all(); */
    $usuarios = new User();
    $usuarios->firstname = $request->inputUser;
    $usuarios->lastname =  $request->inputApe;
    $usuarios->email =  $request->inputEmail;
    $usuarios->password =  Hash::make('password');
    $usuarios->save();

    return redirect()->route('viewUser')
      ->with([
        'mensaje' => 'El Registro se ha guardado correctamente',
        'tipo' => 'danger'
      ]);
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
  public function comparisonUser($id)
  {
    $consultaIds = User::getUsers($id);
    $userSelect = $consultaIds[0]->id_employee;
    $userLog = Auth()->user()->id_employee;
    if ($userLog === $userSelect) {
      return true;
    } else {
      return $consultaIds;
    }
  }
  public function viewEdit($id)
  {
    $valor = $this->comparisonUser($id);

    if ($valor === true) {

      return redirect()->route('viewUser')
        ->with([
          'mensaje' => 'No se puede modificar un usuario autenticado',
          'tipo' => 'danger'
        ]);
    } else {
      $consultaId = $valor;
      return view('usuarios.editUsers', compact('consultaId'));
    }
  }

  public function deleteUser($id)
  {
    $valor = $this->comparisonUser($id);
    if ($valor === true) {
      return redirect()->route('viewUser')
        ->with([
          'mensaje' => 'No se puede eliminar un usuario autenticado',
          'tipo' => 'danger'
        ]);
    } else {
      User::deleteUsers($id);
      return redirect()->route('viewUser')
        ->with([
          'mensaje' => 'Usuario Eliminado',
          'tipo' => 'danger'
        ]);
    }
  }
  public function viewPass()
  {
    return view('auth.passwords.email');
  }

  public function saveEditUser(Request $request)
  {
    $datos = $request->all();
    User::saveChangesUser($datos);
    return view('usuarios.usuarios');
  }
}
