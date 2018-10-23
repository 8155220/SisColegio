<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\User;
use sistema_colegio\Models\bitacora;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use DB;

class BitacoraController extends Controller
{

       public function __construct()
       {
         $this->middleware('auth');
       }
    public function index(Request $request)
    {
      if($request)
      {
        $query=trim($request->get('searchText'));
        $bitacora = DB::table('bitacora')
          ->where('idusuario','LIKE','%'.$query.'%')
        ->paginate(20);

        return view('admUsuario.bitacora.index',["instanciabitacora"=>$bitacora,"searchText"=>$query]);
      }
    }

    public function edit($id)
    {

      $bitacora = DB::table('detallebitacora')
      ->where('idbitacora',$id)->paginate(10);
      return view('admUsuario.bitacora.edit',['instanciabitacora'=>$bitacora]);

    }
}
