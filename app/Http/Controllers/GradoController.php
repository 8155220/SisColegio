<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Http\Requests\GradoFormRequest;
use sistema_colegio\Models\Grado;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class GradoController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    if($request)
    {
      //gestionactual
      $gestion= DB::table('gestion')
      ->where('idestado','=',1)->first();

      $query=trim($request->get('searchText'));
      $grado = DB::table('grado')
      ->where('descripcion','LIKE','%'.$query.'%')
      ->where('idgestion','=',$gestion->idgestion)
      ->orderBy('idgrado','asc')->paginate(6);
      return view('apertura.gestionarGrado.index',
      ["instanciagrado"=>$grado,
      "searchText"=>$query]);

    }
  }
  public function create()
  {

       return view('apertura.gestionarGrado.create');
  }

  public function store(GradoFormRequest $request)
  {

    $gestion= DB::table('gestion')
    ->where('idestado','=',1)->first();
    $grado = new Grado;
    $grado->descripcion=$request->get('descripcion');
    $grado->idgestion=$gestion->idgestion;
    $grado->save();

    Session::flash('message-success','El Grado fue creado exitosamente');
    return Redirect::to('apertura/gestionarGrado');
  }

  public function show($id)
  {
    return view("apertura.gestionarGrado.show",["instanciagrado"=>grado::findOrFail($id)]);

  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

    $grado = DB::table('grado')->where('idgrado',$id)->first();
    return view('apertura.gestionarGrado.edit',['instanciagrado'=>$grado]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update( GradoFormRequest $request, $id)
  {

    $grado = Grado::findOrFail($id);
    $grado->descripcion=$request->request->get('descripcion');
    $grado->update();
    Session::flash('message-success','Los datos fueron editados correctamente');
    return Redirect::to('apertura/gestionarGrado');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $grado =grado::findOrFail($id);
    $grado->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/gestionarGrado');
  }
}
