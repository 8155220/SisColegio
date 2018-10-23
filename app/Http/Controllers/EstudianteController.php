<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Estudiante;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\TipoUsuario;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;

class EstudianteController extends Controller
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
        $estudiante = DB::table('estudiante')
//        ->where('nombre','LIKE','%'.$query.'%')
        ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno) as nombrecompleto
        ,idestudiante
        ,rude
        ,idtutor
        ,estado.descripcion as estadodescripcion
        ,estudiante.idpersona,persona.ci
        '))
        //->where('users.idtipousuario','=','1')
        ->join('persona','estudiante.idpersona','=','persona.ci')
        ->join('estado','estudiante.idestado','=','estado.idestado')
        ->orderBy('estudiante.idestudiante','asc')->paginate(6);
        return view('academico.gestionarEstudiante.index',["instanciaestudiante"=>$estudiante,"searchText"=>$query]);
      }
    }
    public function create()
    {
        $tutor = DB::table('tutor')
        ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno) as nombrecompleto,tutor.idtutor'))
        ->join('persona','persona.ci','=','tutor.idpersona')
        ->pluck('nombrecompleto','idtutor');
         return view('academico.gestionarEstudiante.create',['tutor'=>$tutor]);
    }
    public function store(Request $request)
    {

      $persona = new Persona;
      $usuario = new Usuario;
      $estudiante = new Estudiante;

      $persona->ci=$request->get('ci');
      $persona->nombre=$request->get('nombre');
      $persona->apellidopaterno=$request->get('apellidopaterno');
      $persona->apellidomaterno=$request->get('apellidomaterno');
      $persona->sexo=$request->get('sexo');
      //$persona->fechanacimiento=$request->get('fechanacimiento');
      $persona->telefono=$request->get('telefono');
      $persona->direccion=$request->get('direccion');
      $persona->save();

      $usuario->email=$request->get('email');
      $usuario->password=bcrypt($request->get('ci'));
      $usuario->idtipousuario=1;
      $usuario->idpersona=$request->get('ci');
      $usuario->save();

      $estudiante->rude=$request->get('rude');
      $estudiante->idpersona=$request->get('ci');
      $estudiante->idestado=1;
      $estudiante->idtutor=$request->get('tutor');

      $estudiante->save();

      return Redirect::to('academico/gestionarEstudiante');
    }
    public function show($id)
    {

    }
    public function edit($id)
    {

      $estudiante = DB::table('persona')
      -> join('estudiante','estudiante.idpersona','=','persona.ci')
      ->where('estudiante.idestudiante',$id)
      ->orderBy('estudiante.idestudiante','desc')->first();

      $tutor = DB::table('tutor')
      ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno) as nombrecompleto,tutor.idtutor'))
      ->join('persona','persona.ci','=','tutor.idpersona')
      ->pluck('nombrecompleto','idtutor');

      return view('academico.gestionarEstudiante.edit',['instanciaestudiante'=>$estudiante, 'tutor'=>$tutor]);
    }

    public function update( Request $request, $id)
    {
      $estudiante = Estudiante::findOrFail($id);
      $persona = Persona::findOrFail($estudiante->idpersona);
      $persona->nombre=$request->request->get('nombre');
      $persona->apellidopaterno=$request->request->get('apellidopaterno');
      $persona->apellidomaterno=$request->request->get('apellidomaterno');
      $persona->sexo=$request->request->get('sexo');
      $persona->fechanacimiento=$request->request->get('fechanacimiento');
      $persona->update();

      $estudiante->rude=$request->request->get('rude');
      $estudiante->idestado=$request->request->get('idestado');
      $estudiante->idtutor=$request->request->get('idtutor');
      $estudiante->update();

      return Redirect::to('academico/gestionarEstudiante');
    }
    public function destroy($id)
    {
      $persona =Persona::findOrFail($id);
      $persona->delete();
      return Redirect::to('academico/gestionarEstudiante');
    }
}
