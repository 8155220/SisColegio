<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Http\Requests\AulaFormRequest;
use sistema_colegio\Models\Aula;
use sistema_colegio\Models\Gestion;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class AulaController extends Controller
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
      $aula = DB::table('aula')
      ->where('descripcion','LIKE','%'.$query.'%')
      ->where('idgestion','=',$gestion->idgestion)
      ->orderBy('idaula','asc')->paginate(6);
      return view('apertura.gestionarAula.index',["instanciaaula"=>$aula,"searchText"=>$query]);
    }
  }
  public function create()
  {

       return view('apertura.gestionarAula.create');
  }

  public function store(AulaFormRequest $request)
  {

    $aula = new Aula;
    $aula->descripcion=$request->get('descripcion');
    $aula->capacidad=$request->get('capacidad');
    $aula->idgestion=Gestion::getGestion();
    $aula->save();
    Session::flash('message-success','Los Datos fueron creados exitosamente');
    return Redirect::to('apertura/gestionarAula');
  }

  public function show($id)
  {
    return view("apertura.gestionarAula.show",["instanciaaula"=>aula::findOrFail($id)]);

  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $aula = DB::table('aula')->where('idaula',$id)->first();
    return view('apertura.gestionarAula.edit',['instanciaaula'=>$aula]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update( AulaFormRequest $request, $id)
  {

    $aula = Aula::findOrFail($id);
    $aula->descripcion=$request->request->get('descripcion');
    $aula->capacidad=$request->request->get('capacidad');
    $aula->update();
    Session::flash('message-success','Los datos fueron editados correctamente');
    return Redirect::to('apertura/gestionarAula');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $aula =aula::findOrFail($id);
    $aula->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/gestionarAula');
  }
}
