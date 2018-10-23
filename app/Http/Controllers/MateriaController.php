<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Http\Requests\MateriaFormRequest;
use sistema_colegio\Models\Materia;
use sistema_colegio\Models\Gestion;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class MateriaController extends Controller
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
      $materia = DB::table('materia')
      ->where('descripcion','LIKE','%'.$query.'%')
      ->where('idgestion','=',$gestion->idgestion)
      ->orderBy('idmateria','asc')->paginate(6);
      return view('apertura.gestionarMateria.index',["instanciamateria"=>$materia,"searchText"=>$query]);
    }
  }
  public function create()
  {

       return view('apertura.gestionarMateria.create');
  }

  public function store(MateriaFormRequest $request)
  {

    $materia = new Materia;
    $materia->descripcion=$request->get('descripcion');
    $materia->idgestion=Gestion::getGestion();
    $materia->save();
    Session::flash('message-success','Los Datos fueron creados exitosamente');
    return Redirect::to('apertura/gestionarMateria');
  }

  public function show($id)
  {
    return view("apertura.gestionarMateria.show",["instanciamateria"=>materia::findOrFail($id)]);

  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $materia = DB::table('materia')->where('idmateria',$id)->first();
    return view('apertura.gestionarMateria.edit',['instanciamateria'=>$materia]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(MateriaFormRequest $request, $id)
  {

    $materia = Materia::findOrFail($id);
    $materia->descripcion=$request->request->get('descripcion');
    $materia->update();
    Session::flash('message-success','Los datos fueron editados correctamente');
    return Redirect::to('apertura/gestionarMateria');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $materia =materia::findOrFail($id);
    $materia->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/gestionarMateria');
  }
}
