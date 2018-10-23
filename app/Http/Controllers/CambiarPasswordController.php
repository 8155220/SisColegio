<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\TipoUsuario;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

use DB;

class CambiarPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function __construct()
       {
         $this->middleware('auth');
       }
    public function index(Request $request)
    {

        return view('perfil.cambiarPassword.index');

    }

    public function store(Request $request)
    {
      $usuario = Auth::user();
      $oldpassword = $request->get('oldpassword');
      $newpassword = $request->get('newpassword');
      $newpassword2 = $request->get('newpassword2');
      if (Hash::check($oldpassword, $usuario->password)) {
        if($newpassword!=$newpassword2)
        {
        Session::flash('message-error','La nueva Contraseña no Coincide');
        return Redirect::to('perfil/cambiarPassword');
        }
        else {
          $usuario->password=bcrypt($request->get('newpassword'));
          $usuario->update();
          Session::flash('message-success','La contraseña se cambio exitosamente');
          return Redirect::to('perfil/cambiarPassword');
        }
      }
      else {
        Session::flash('message-error','La Contraseña Actual no coincide');
        return Redirect::to('perfil/cambiarPassword');
      }


    }


}
