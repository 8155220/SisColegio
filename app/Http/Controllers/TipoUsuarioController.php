<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Models\TipoUsuario;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use Illuminate\Support\Collection;

class TipoUsuarioController extends Controller
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
      $tipousuario = DB::table('tipousuario')->where('descripcion','LIKE','%'.$query.'%')
      ->orderBy('idtipousuario','asc')->paginate(5);
     // return view('admUsuario.gestionarTipoUsuario.index',["instanciatipousuario"=>$tipousuario,"searchText"=>$query]);
      return view('admUsuario.gestionarTipoUsuario.index',["instanciatipousuario"=>$tipousuario,"searchText"=>$query]);
    }
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


  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

       return view('admUsuario.gestionarTipoUsuario.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $tipousuario = new TipoUsuario;

    $tipousuario->descripcion=$request->get('descripcion');
    $tipousuario->save();
    return Redirect::to('admUsuario/gestionarTipoUsuario');
  // return true;php
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return view("admUsuario.gestionarTipoUsuario.show",["instanciatipousuario"=>TipoUsuario::findOrFail($id)]);

  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $tipousuario = DB::table('tipousuario')->where('idtipousuario',$id)->first();
    return view('admUsuario.gestionarTipoUsuario.edit',['instanciatipousuario'=>$tipousuario]);
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
