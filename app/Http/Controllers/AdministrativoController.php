<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Administrativo;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\TipoUsuario;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;

class AdministrativoController extends Controller
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
        $administrativo = DB::table('persona')
        -> join('users','persona.ci','=','users.idpersona')
        ->where('nombre','LIKE','%'.$query.'%')
        ->where('users.idtipousuario','=','3')
        ->orderBy('users.id','desc')->paginate(6);
        return view('apertura.gestionarAdministrativo.index',["instanciaadministrativo"=>$administrativo,"searchText"=>$query]);
      }
    }
    public function create()
    {


         return view('apertura.gestionarAdministrativo.create');
    }
    public function store(Request $request)
    {

      $persona = new Persona;
      $usuario = new Usuario;
      $administrativo = new Administrativo;

      $persona->ci=$request->get('ci');
      $persona->nombre=$request->get('nombre');
      $persona->apellidopaterno=$request->get('apellidopaterno');
      $persona->apellidomaterno=$request->get('apellidomaterno');
      $persona->sexo=$request->get('sexo');
      $persona->fechanacimiento=$request->get('fechanacimiento');
      $persona->telefono=$request->get('telefono');
      $persona->direccion=$request->get('direccion');
      $persona->save();

      $usuario->email=$request->get('email');
      $usuario->password=bcrypt($request->get('ci'));
      $usuario->idtipousuario=3;
      $usuario->idpersona=$request->get('ci');
      $usuario->save();

      $administrativo->profesion=$request->get('profesion');
      $administrativo->cargo=$request->get('cargo');
      $administrativo->idpersona=$request->get('ci');
      $administrativo->idestado=1;
      $administrativo->save();

      return Redirect::to('apertura/gestionarAdministrativo');
    }
    public function show($id)
    {

    }
    public function edit($id)
    {

      $administrativo = DB::table('persona')
      -> join('users','persona.ci','=','users.idpersona')->where('users.id',$id)
      -> join('administrativo','administrativo.idpersona','=','users.idpersona')
      ->where('users.id',$id)
      ->orderBy('users.id','desc')->first();
      return view('apertura.gestionarAdministrativo.edit',['instanciaadministrativo'=>$administrativo]);

    }

    public function update( Request $request, $id)
    {
      $administrativo = Administrativo::findOrFail($id);
      $persona = Persona::findOrFail($administrativo->idpersona);
      $persona->nombre=$request->request->get('nombre');
      $persona->apellidopaterno=$request->request->get('apellidopaterno');
      $persona->apellidomaterno=$request->request->get('apellidomaterno');
      $persona->sexo=$request->request->get('sexo');
      $persona->fechanacimiento=$request->request->get('fechanacimiento');
      $persona->update();

      $administrativo->profesion=$request->request->get('profession');
      $administrativo->update();
      return Redirect::to('apertura/gestionarAdministrativo');
    }
    public function destroy($id)
    {
      $persona =Persona::findOrFail($id);
      $persona->delete();
      return Redirect::to('apertura/gestionarAdministrativo');
    }
}
