<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
//use sistema_colegio\Http\Requests;
use sistema_colegio\Models\Cliente;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Http\Controllers\UsuarioController;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use DB;



class ClienteController extends Controller
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
    if($request)
    {
      $query=trim($request->get('searchText'));
      $usuario = DB::table('persona')
      -> join('users','persona.ci','=','users.idpersona')
      ->where('nombre','LIKE','%'.$query.'%')
      ->where('tipousuario','=','1')
      ->orderBy('users.id','desc')->paginate(6);

      return view('admCredito.gestionarCliente.index',["instanciausuario"=>$usuario,"searchText"=>$query]);
    }
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
       return view('admCredito.gestionarCliente.create');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
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
    $usuario->tipousuario=1;
    $usuario->idpersona=$request->get('ci');

    $usuario->save();
    return Redirect::to('admCredito/gestionarCliente');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {


  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $usuario = DB::table('persona') -> join('users','persona.ci','=','users.idpersona')->where('users.id',$id)
    ->orderBy('users.id','desc')->first();
    return view('admCredito.gestionarCliente.edit',['usuario'=>$usuario]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
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

    $usuario->update();
    return Redirect::to('admCredito/gestionarCliente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $persona =Persona::findOrFail($id);
    $persona->delete();
    return Redirect::to('admCredito/gestionarCliente');
  }
}
