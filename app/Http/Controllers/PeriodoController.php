<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Http\Requests\PeriodoFormRequest;
use sistema_colegio\Models\Periodo;
use sistema_colegio\Models\DetalleGestionTurno;
use sistema_colegio\Models\Gestion;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class PeriodoController extends Controller
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

      $turno = DetalleGestionTurno::
      where('idgestion','=',$gestion->idgestion)
      ->join('turno','turno.idturno','=','DetalleGestionTurno.idturno')
      ->pluck('turno.descripcion','iddetallegestionturno');

      $periodo = DB::table('periodo')
      ->select(DB::raw('turno.descripcion as descripcionturno,idperiodo,periodo.descripcion,periodo.horainicio,periodo.horafin'))
      ->join('detallegestionturno','periodo.iddetallegestionturno','=','detallegestionturno.iddetallegestionturno')
      ->join('turno','detallegestionturno.idturno','=','turno.idturno')
     // ->where('periodo.descripcion','LIKE','%'.$query.'%')
      ->where('periodo.iddetallegestionturno','like','%'.$iddetallegestionturno.'%')
      ->orderBy('idperiodo','asc')->simplePaginate(6);
      return view('apertura.gestionarPeriodo.index',["instanciaperiodo"=>$periodo,"searchText"=>$query,"turno"=>$turno,'iddetallegestionturno'=>$iddetallegestionturno]);
    }
  }
  public function create()
  {
      $detallegestionturno = DetalleGestionTurno::
      where('idgestion','=',Gestion::getGestion())
      ->join('turno','turno.idturno','=','DetalleGestionTurno.idturno')
      ->pluck('turno.descripcion','iddetallegestionturno');
      return view('apertura.gestionarPeriodo.create'
      ,['instanciadetallegestionturno'=>$detallegestionturno]);
  }

  public function store(PeriodoFormRequest $request)
  {

    $periodo = new Periodo;
    $periodo->iddetallegestionturno=$request->get('iddetallegestionturno');
    $periodo->descripcion=$request->get('descripcion');
    $periodo->horainicio=$request->get('horainicio');
    $periodo->horafin=$request->get('horafin');
    $periodo->save();
    Session::flash('message-success','Los Datos fueron creados exitosamente');
    return Redirect::to('apertura/gestionarPeriodo');
  }

  public function show($id)
  {
    return view("apertura.gestionarPeriodo.show",["instanciaperiodo"=>periodo::findOrFail($id)]);

  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $detallegestionturno = DetalleGestionTurno::
    where('idgestion','=',Gestion::getGestion())
    ->join('turno','turno.idturno','=','DetalleGestionTurno.idturno')
    ->pluck('turno.descripcion','iddetallegestionturno');

    $periodo = DB::table('periodo')->where('idperiodo',$id)->first();
    return view('apertura.gestionarPeriodo.edit',['instanciaperiodo'=>$periodo,'instanciadetallegestionturno'=>$detallegestionturno]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update( PeriodoFormRequest $request, $id)
  {

    $periodo = Periodo::findOrFail($id);
    $periodo->iddetallegestionturno=$request->get('iddetallegestionturno');
    $periodo->descripcion=$request->get('descripcion');
    $periodo->horainicio=$request->get('horainicio');
    $periodo->horafin=$request->get('horafin');
    $periodo->update();
    Session::flash('message-success','Los datos fueron editados correctamente');
    return Redirect::to('apertura/gestionarPeriodo');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $periodo =periodo::findOrFail($id);
    $periodo->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/gestionarPeriodo');
  }
  //devuelve los periodos de un turno espesificado ( ej solo periodos turno tarde mañana etc)
  public function getPeriodo(Request $request,$id)
  {
    if($request->ajax()){
     $periodo = DB::table('periodo')
     ->where('periodo.iddetallegestionturno',$id);
      return response()->json($periodo);
    }
  }
}
