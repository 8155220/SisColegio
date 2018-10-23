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

use DB;

class UsuarioController extends Controller
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
        $usuario = DB::table('persona')
        -> join('users','persona.ci','=','users.idpersona')
        ->where('nombre','LIKE','%'.$query.'%')
        ->orderBy('users.id','desc')->paginate(6);

        return view('admUsuario.gestionarUsuario.index',["instanciausuario"=>$usuario,"searchText"=>$query]);
      }
    }
      public function create()
    {

          $tipousuario = TipoUsuario::pluck('descripcion','idtipousuario');

         return view('admUsuario.gestionarUsuario.create')->with('tipousuario',$tipousuario);
    }
    public function store(Request $request)
    {

      $persona = new Persona;
      $usuario = new Usuario;

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
      $usuario->idtipousuario=$request->get('idtipousuario');
      $usuario->idpersona=$request->get('ci');
      $usuario->save();
      return Redirect::to('admUsuario/gestionarUsuario');
    }
    public function show($id)
    {
      return view("inscripcion.estudiante.show",["estudiante"=>Estudiante::findOrFail($id)->toJson()]);

    }
    public function edit($id)
    {

      $usuario = DB::table('persona') -> join('users','persona.ci','=','users.idpersona')->where('users.id',$id)
      ->orderBy('users.id','desc')->first();
      $tipousuario = TipoUsuario::pluck('descripcion','idtipousuario');
      return view('admUsuario.gestionarUsuario.edit',['usuario'=>$usuario],['tipousuario'=>$tipousuario]);

    }

    public function update( Request $request, $id)
    {
      $usuario = Usuario::findOrFail($id);
      $persona = Persona::findOrFail($usuario->idpersona);
      $persona->nombre=$request->request->get('nombre');
      $persona->apellidopaterno=$request->request->get('apellidopaterno');
      $persona->apellidomaterno=$request->request->get('apellidomaterno');
      $persona->sexo=$request->request->get('sexo');
      $persona->fechanacimiento=$request->request->get('fechanacimiento');
      $persona->update();

      //$usuario->tipousuario=$request->request->get('idtipousuario');//$request->get('idgrado');

      $usuario->update();
      return Redirect::to('admUsuario/gestionarUsuario');
    }
    public function destroy($id)
    {
      $persona =Persona::findOrFail($id);
      $persona->delete();
      return Redirect::to('admUsuario/gestionarUsuario');
    }
}
