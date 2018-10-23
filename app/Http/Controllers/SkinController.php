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

use DB;

class SkinController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
    public function index()
    {
        return view('perfil/skin.index');
    }

    public function store(Request $request)
    {

      $usuario = Auth::user();
      $skin =  $request->get('skin');
      $usuario->skin=$skin;
      $usuario->update();
      return Redirect::to('perfil/skin');
    }

}
