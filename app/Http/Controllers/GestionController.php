<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests\GestionFormRequest;
use sistema_colegio\Models\Gestion;
use sistema_colegio\Models\DetalleGestionTurno;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class GestionController extends Controller
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
      $gestion = DB::table('gestion')->where('descripcion','LIKE','%'.$query.'%')
      ->orderBy('idgestion','asc')->paginate(6);
      return view('apertura.aperturaGestion.index',["instanciagestion"=>$gestion,"searchText"=>$query]);
    }
  }
  public function create()
  {

       return view('apertura.aperturaGestion.create');
  }

  public function store(GestionFormRequest $request)
  {

    $gestion = new Gestion;
    $gestion->descripcion=$request->get('descripcion');
    $gestion->fechainicio=$request->get('fechainicio');
    $gestion->fechafin=$request->get('fechafin');
    $gestion->idestado=2;
    $gestion->save();
    Session::flash('message-success','Los Datos fueron creados exitosamente');
    return Redirect::to('apertura/aperturaGestion');
  }

  public function show($id)
  {
    return view("apertura.aperturaGestion.show",["instanciagestion"=>gestion::findOrFail($id)]);

  }
  public function edit($id)
  {
    $gestionturno = DB::table('detallegestionturno')->where('idgestion',$id)->paginate(6);
    $gestion = DB::table('gestion')->where('idgestion',$id)->first();
    return view('apertura.aperturaGestion.edit',['instanciagestionturno'=>$gestionturno , 'instanciagestion'=>$gestion]);
  }

  public function update( Request $request, $id)
  {
    $gestion = Gestion::findOrFail($id);
    //$gestion->descripcion=$request->request->get('descripcion');

    $periodo = DB::table('gestion')
    ->select(DB::raw('count(idgestion) as cantidad'))
    ->where('idestado','1')->first();
    if($gestion->idestado!=$request->idestado)
    {
      if($request->idestado==1)
      {
        if($periodo->cantidad==1)
        {
          Session::flash('message-error','Primero debe deshabilitar la gestion activa');
          return Redirect::to('apertura/aperturaGestion/'.$id.'/edit');
        }
        else {

          $gestion->idestado=$request->request->get('idestado');
          $gestion->update();
          Session::flash('message-success','La gestion fue activada correctamente');
          return Redirect::to('apertura/aperturaGestion');
        }
      }
        else {
          $gestion->idestado=$request->request->get('idestado');
          $gestion->update();
          Session::flash('message-success','La gestion fue activada correctamente');
          return Redirect::to('apertura/aperturaGestion');
        }

  }

    //return Redirect::to('apertura/aperturaGestion');
  }

  public function destroy($id)
  {
    $gestion = Gestion::findOrFail($id);
    $gestion->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/aperturaGestion');
  }
}
