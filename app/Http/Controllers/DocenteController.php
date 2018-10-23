<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Docente;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\TipoUsuario;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;

class DocenteController extends Controller
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
        $docente = DB::table('persona')
        -> join('users','persona.ci','=','users.idpersona')
        ->where('nombre','LIKE','%'.$query.'%')
        ->where('users.idtipousuario','=','2')
        ->orderBy('users.id','desc')->paginate(6);
        return view('apertura.gestionarDocente.index',["instanciadocente"=>$docente,"searchText"=>$query]);
      }
    }
    public function create()
    {


         return view('apertura.gestionarDocente.create');
    }
    public function store(Request $request)
    {

      $persona = new Persona;
      $usuario = new Usuario;
      $docente = new Docente;

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
      $usuario->idtipousuario=2;
      $usuario->idpersona=$request->get('ci');
      $usuario->save();

      $docente->profesion=$request->get('profesion');
      $docente->idpersona=$request->get('ci');
      $docente->idestado=1;
      $docente->save();

      return Redirect::to('apertura/gestionarDocente');
    }
    public function show($id)
    {

    }
    public function edit($id)
    {

      $docente = DB::table('persona')
      -> join('users','persona.ci','=','users.idpersona')->where('users.id',$id)
      -> join('docente','docente.idpersona','=','users.idpersona')
      ->where('users.id',$id)
      ->orderBy('users.id','desc')->first();
      return view('apertura.gestionarDocente.edit',['instanciadocente'=>$docente]);

    }

    public function update( Request $request, $id)
    {
      $docente = Docente::findOrFail($id);
      $persona = Persona::findOrFail($docente->idpersona);
      $persona->nombre=$request->request->get('nombre');
      $persona->apellidopaterno=$request->request->get('apellidopaterno');
      $persona->apellidomaterno=$request->request->get('apellidomaterno');
      $persona->sexo=$request->request->get('sexo');
      $persona->fechanacimiento=$request->request->get('fechanacimiento');
      $persona->update();

      $docente->profesion=$request->request->get('profession');
      $docente->update();
      return Redirect::to('apertura/gestionarDocente');
    }
    public function destroy($id)
    {
      $persona =Persona::findOrFail($id);
      $persona->delete();
      return Redirect::to('apertura/gestionarDocente');
    }
}
