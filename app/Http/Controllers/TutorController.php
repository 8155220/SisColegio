<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Tutor;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\TipoUsuario;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;

class TutorController extends Controller
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
        $tutor = DB::table('tutor')
//        ->where('nombre','LIKE','%'.$query.'%')
        //->where('users.idtipousuario','=','2')
        ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno) as nombrecompleto
        ,idtutor
        ,estado.descripcion as estadodescripcion
        ,idpersona
        ,ci
        '))
        ->join('persona','tutor.idpersona','=','persona.ci')
        ->join('estado','tutor.idestado','=','estado.idestado')
        ->orderBy('tutor.idtutor','asc')->paginate(6);
        return view('academico.gestionarTutor.index',["instanciatutor"=>$tutor,"searchText"=>$query]);
      }
    }
    public function create()
    {
        $tutor = DB::table('tutor')
        ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno) as nombrecompleto,tutor.idtutor'))
        ->join('persona','persona.ci','=','tutor.idpersona')
        ->pluck('nombrecompleto','idtutor');
         return view('academico.gestionarTutor.create');
    }
    public function store(Request $request)
    {

      $persona = new Persona;
      $usuario = new Usuario;
      $tutor = new Tutor;

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
      $usuario->idtipousuario=4;
      $usuario->idpersona=$request->get('ci');
      $usuario->save();

      $tutor->idpersona=$request->get('ci');
      $tutor->idestado=1;
      $tutor->save();

      return Redirect::to('academico/gestionarTutor');
    }
    public function show($id)
    {

    }
    public function edit($id)
    {

      $tutor = DB::table('persona')
      -> join('tutor','tutor.idpersona','=','persona.ci')
      ->where('tutor.idtutor',$id)
      ->orderBy('tutor.idtutor','desc')->first();

    /*  $tutor = DB::table('tutor')
      ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno) as nombrecompleto,tutor.idtutor'))
      ->join('persona','persona.ci','=','tutor.idpersona')
      ->pluck('nombrecompleto','idtutor');*/

      return view('academico.gestionarTutor.edit',['instanciatutor'=>$tutor]);
    }

    public function update( Request $request, $id)
    {

      $tutor = Tutor::findOrFail($id);
      $persona = Persona::findOrFail($tutor->idpersona);
      $persona->nombre=$request->request->get('nombre');
      $persona->apellidopaterno=$request->request->get('apellidopaterno');
      $persona->apellidomaterno=$request->request->get('apellidomaterno');
      $persona->sexo=$request->request->get('sexo');
      $persona->fechanacimiento=$request->request->get('fechanacimiento');
      $persona->update();

      $tutor->idestado=$request->request->get('idestado');
      $tutor->update();

      return Redirect::to('academico/gestionarTutor');

    }
    public function destroy($id)
    {
      $persona =Persona::findOrFail($id);
      $persona->delete();
      return Redirect::to('academico/gestionarTutor');
    }
}
