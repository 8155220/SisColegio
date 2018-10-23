<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Models\Bloque;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class BloqueController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    if($request)
    {
      $gestion= DB::table('gestion')
      ->where('idestado','=',1)->first();

      $query=trim($request->get('searchText'));
      $bloque = DB::table('bloque')
      ->where('descripcion','LIKE','%'.$query.'%')
      ->where('idgestion','=',$gestion->idgestion)
      ->orderBy('idbloque','asc')->paginate(6);
      return view('apertura.gestionarBloque.index',["instanciabloque"=>$bloque,"searchText"=>$query]);
    }
  }
  public function create()
  {

       return view('apertura.gestionarBloque.create');
  }

  public function store(Request $request)
  {
    $gestion= DB::table('gestion')
    ->where('idestado','=',1)->first();

    $bloque = new Bloque;
    $bloque->descripcion=$request->get('descripcion');
    $bloque->idgestion=$gestion->idgestion;
    $bloque->save();
    Session::flash('message-success','Los Datos fueron creados exitosamente');
    return Redirect::to('apertura/gestionarBloque');
  }

  public function show($id)
  {
    return view("apertura.gestionarBloque.show",["instanciabloque"=>bloque::findOrFail($id)]);

  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $bloque = DB::table('bloque')->where('idbloque',$id)->first();
    return view('apertura.gestionarBloque.edit',['instanciabloque'=>$bloque]);
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

    $bloque = Bloque::findOrFail($id);
    $bloque->descripcion=$request->request->get('descripcion');
    $bloque->update();
    Session::flash('message-success','Los datos fueron editados correctamente');
    return Redirect::to('apertura/gestionarBloque');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $bloque =bloque::findOrFail($id);
    $bloque->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/gestionarBloque');
  }
}
