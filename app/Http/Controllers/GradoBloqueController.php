<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Http\Requests\GradoBloqueFormRequest;
use sistema_colegio\Models\DetalleGradoBloque;
use sistema_colegio\Models\DetalleGestionTurno;
use sistema_colegio\Models\Grado;
use sistema_colegio\Models\Bloque;
use sistema_colegio\Models\Gestion;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class GradoBloqueController extends Controller
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

      $iddetallegestionturno = $request->get('idturno');
      $query=trim($request->get('searchText'));

      if($request->get('idturno')!=null)
      {
         $gradobloque = DB::table('detallegradobloque')
        ->where('idgrado','LIKE','%'.$query.'%')
        ->where('iddetallegestionturno','=',$iddetallegestionturno)
        ->orderBy('iddetallegradobloque','asc')->paginate(40);
      } else {
        $gradobloque = DB::table('detallegradobloque')
       ->where('idgrado','LIKE','%'.$query.'%')
       //->where('iddetallegestionturno','like',$detallegestionturno->iddetallegestionturno)
       ->orderBy('iddetallegradobloque','asc')->paginate(40);
      }

      $turno = DetalleGestionTurno::
      where('idgestion','=',$gestion->idgestion)
      ->join('turno','turno.idturno','=','DetalleGestionTurno.idturno')
      ->pluck('turno.descripcion','iddetallegestionturno');


      return view('apertura.gestionarGradoBloque.index',
      ["instanciagradobloque"=>$gradobloque,
      "searchText"=>$query,
      "turno"=>$turno]);
    }
  }
  public function create()
  {
      $gestion= DB::table('gestion')
      ->where('idestado','=',1)->first();
      $grado = Grado::pluck('descripcion','idgrado');
      $bloque = Bloque::pluck('descripcion','idbloque');
      $detallegestionturno = DetalleGestionTurno::
      where('idgestion','=',$gestion->idgestion)
      ->join('turno','turno.idturno','=','DetalleGestionTurno.idturno')
      ->pluck('turno.descripcion','iddetallegestionturno');

      return view('apertura.gestionarGradoBloque.create',
      ["instanciagrado"=>$grado,
      "instanciabloque"=>$bloque,
      "instanciadetallegestionturno"=>$detallegestionturno]);
  }
  public function store(GradoBloqueFormRequest $request)
  {

    $gradobloque = new DetalleGradoBloque;
    $gradobloque->iddetallegestionturno=$request->get('iddetallegestionturno');
    $gradobloque->idgrado=$request->get('idgrado');
    $gradobloque->idbloque=$request->get('idbloque');
    $gradobloque->cupototal=$request->get('cupototal');
    $gradobloque->cuporestante=$request->get('cupototal');
    $gradobloque->save();
    Session::flash('message-success','Los Datos fueron creados exitosamente');
    return Redirect::to('apertura/gestionarGradoBloque');
  }

  public function show($id)
  {
    return view("apertura.gestionarGradoBloque.show",["instanciagradobloque"=>GradoBloque::findOrFail($id)]);

  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $gestion= DB::table('gestion')
    ->where('idestado','=',1)->first();
    $detallegestionturno = DetalleGestionTurno::
    where('idgestion','=',$gestion->idgestion)
    ->join('turno','turno.idturno','=','DetalleGestionTurno.idturno')
    ->pluck('turno.descripcion','iddetallegestionturno');
    $grado = Grado::pluck('descripcion','idgrado');
    $bloque = Bloque::pluck('descripcion','idbloque');
    $gradobloque = DB::table('detallegradobloque')->where('iddetallegradobloque',$id)->first();
    return view('apertura.gestionarGradoBloque.edit',[
      'instanciagradobloque'=>$gradobloque,
      "instanciagrado"=>$grado,
      "instanciabloque"=>$bloque,
      "instanciadetallegestionturno"=>$detallegestionturno
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(GradoBloqueFormRequest $request, $id)
  {

    $gradobloque = DetalleGradoBloque::findOrFail($id);
    $gradobloque->iddetallegestionturno=$request->get('iddetallegestionturno');
    $gradobloque->idgrado=$request->get('idgrado');
    $gradobloque->idbloque=$request->get('idbloque');
    $gradobloque->cupototal=$request->get('cupototal');
    $gradobloque->cuporestante=$request->get('cupototal');
    $gradobloque->update();
    Session::flash('message-success','Los datos fueron editados correctamente');
    return Redirect::to('apertura/gestionarGradoBloque');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $gradobloque =DetalleGradoBloque::findOrFail($id);
    $gradobloque->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/gestionarGradoBloque');
  }
  public function getCupo(Request $request, $id1, $id2,$id3)
  {
    // $id = idgrado ;
    // $id2 = iddetallegestionturno
    if($request->ajax()){
     // $bloque= Bloque::getBloque($id);
     $gradobloque = DB::table('detallegradobloque')
     ->where('iddetallegestionturno',$id1)
     ->where('idgrado',$id2)
     ->where('idbloque',$id3)
     ->first()
     ;
      return response()->json($gradobloque);

    }
  }
}
