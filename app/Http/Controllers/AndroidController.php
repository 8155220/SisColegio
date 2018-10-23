<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Models\TipoUsuario;
use sistema_colegio\Models\Usuario;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AndroidController extends Controller
{
  public function __construct()
  {

  }
  public function index(Request $request)
  {
    return [true];
  }
  public function index2(Request $request)
  {


     $tipousuario = DB::table('prueba')->where('id','1')->get();
      ;
     // return view('admUsuario.gestionarTipoUsuario.index',["instanciatipousuario"=>$tipousuario,"searchText"=>$query]);
     $collection = collect(['id' => '123456', 'content' => 'Json desde laravel']);

     $collection->toJson();
      return $collection;

  }
  public function create()
  {

       return view('admUsuario.gestionarTipoUsuario.create');
  }
  public function store(Request $request)
  {

    $tipousuario = new TipoUsuario;

    $tipousuario->descripcion=$request->get('descripcion');
    $tipousuario->save();
    return Redirect::to('admUsuario/gestionarTipoUsuario');
  // return true;php
  }
  public function verificarUsuario($id1,$id2)
  {
    ////FUNCIONA
   /* //$id1 usuario , $id2 password
    $usuario = DB::table('users')
    ->where('users.email',$id1)
    ->first();
    if($usuario!=null)
    {
      if (Hash::check($id2,$usuario->password))
      return [$usuario];
    }
    return [false];*/
    ///////
    $usuario = Usuario::find(9);
    if($usuario!=null)
    {
      if (Hash::check($id2,$usuario->password))
      return $usuario;
    }
    return null;
  }
  public function edit($id)
  {

    $tipousuario = DB::table('tipousuario')->where('idtipousuario',$id)->first();
    return view('admUsuario.gestionarTipoUsuario.edit',['instanciatipousuario'=>$tipousuario]);
  }
  public function update( Request $request, $id)
  {

    $tipousuario = TipoUsuario::findOrFail($id);

    $tipousuario->descripcion=$request->request->get('descripcion');
    $tipousuario->update();
    return Redirect::to('admUsuario/gestionarTipoUsuario');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $tipousuario =TipoUsuario::findOrFail($id);
    $tipousuario->delete();
    return Redirect::to('admUsuario/gestionarTipoUsuario');
  }
}
