<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Http\Requests\InscripcionFormRequest;
use sistema_colegio\Models\Inscripcion;
use sistema_colegio\Models\Gestion;
use sistema_colegio\Models\Estudiante;
use sistema_colegio\Models\PlanDePago;
use sistema_colegio\Models\Cuota;
use sistema_colegio\Models\DetalleGradoBloque;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use Auth;
use Illuminate\Support\Collection;

class InscripcionController extends Controller
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

      $gestion= DB::table('gestion')
      ->where('idestado','=',1)->first();

      $inscripcion = DB::table('inscripcion')
      //->where('descripcion','LIKE','%'.$query.'%')
      ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno)
      as nombrecompletoadministrativo,idinscripcion,inscripcion.idestudiante,iddetallegradobloque,
      concat(persona2.nombre," ",persona2.apellidopaterno," ",persona2.apellidomaterno)
      as nombrecompletoestudiante, inscripcion.fecha , turno.descripcion as descripcionturno'))
      ->join('administrativo','administrativo.idadministrativo','=','inscripcion.idadministrativo')
      ->join('estudiante','estudiante.idestudiante','=','inscripcion.idestudiante')
      ->join('persona','administrativo.idpersona','=','persona.ci')
      ->join('persona as persona2','estudiante.idpersona','=','persona2.ci')
      ->join('detallegestionturno','detallegestionturno.iddetallegestionturno','=','inscripcion.iddetallegestionturno')
      ->join('turno','turno.idturno','=','detallegestionturno.idturno')
      ->orderBy('idinscripcion','asc')->simplePaginate(20);
      return view('academico.gestionarInscripcion.index',["instanciainscripcion"=>$inscripcion,"searchText"=>$query]);
    }
  }
  public function create()
  {
      $gestion = Gestion::
      where('idestado','=','1')
      ->first();
      $turno = DB::table('detallegestionturno')
      ->where('idgestion',$gestion->idgestion)
      ->join('turno','turno.idturno','detallegestionturno.idturno')
      ->pluck('turno.descripcion','iddetallegestionturno');

      $estudiante = DB::table('estudiante')
      ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno)
      as nombrecompletoestudiante ,estudiante.idestudiante'))
      ->join('persona','persona.ci','=','estudiante.idpersona')
      ->where('estudiante.idestado','1')
      ->pluck('nombrecompletoestudiante','idestudiante');

       return view('academico.gestionarInscripcion.create',[
         'gestion'=>$gestion,
         'estudiante'=>$estudiante,
         'turno'=>$turno]);
  }
  public function store(InscripcionFormRequest $request)
  {
    //return $request->get('cuporestante');
    $inscripcion = new Inscripcion;
    $detallegradobloque = DB::table('detallegradobloque')
    ->where('idgrado',$request->get('idgrado'))
    ->where('idbloque',$request->get('idbloque'))
    ->first();

    $idadministrativo= DB::table('administrativo')
    ->where('idpersona',Auth::user()->idpersona)->first()->idadministrativo;
    $inscripcion->iddetallegestionturno=$request->get('iddetallegestionturno');
    $inscripcion->iddetallegradobloque=$detallegradobloque->iddetallegradobloque;
    $inscripcion->idestudiante=$request->get('idestudiante');
    $inscripcion->idadministrativo=$idadministrativo;

    if($detallegradobloque->cuporestante>0)
    {
      $inscripcion->save();
      $gradobloque = DetalleGradoBloque::find($detallegradobloque->iddetallegradobloque);
      $gradobloque->cuporestante--;
      $gradobloque->save();
      $plandepago = new PlanDePago();
      $plandepago->idinscripcion=$inscripcion->idinscripcion;
      $plandepago->idestudiante=$inscripcion->idestudiante;
      $plandepago->idestado=5;
      $plandepago->montototal=3000;
      $plandepago->save();
      for ($i=1; $i <11 ; $i++) {
        $cuota = new Cuota;
        $cuota->idplandepago = $plandepago->idplandepago;
        $cuota->numerocuota = $i;
        $cuota->monto=$plandepago->montototal/10;
        $cuota->idestado=5;
        $cuota->save();
      }

    }
    $estudiante = Estudiante::findOrFail($inscripcion->idestudiante);
    $estudiante->idestado =3;
    $estudiante->update();



    return Redirect::to('academico/gestionarInscripcion');
  // return true;php
  }
  public function show($id)
  {
    return view("academico.gestionarInscripcion.show",["instanciainscripcion"=>Inscripcion::findOrFail($id)]);

  }
  public function edit($id)
  {

    $inscripcion = DB::table('inscripcion')->where('idinscripcion',$id)->first();
    return view('academico.gestionarInscripcion.edit',['instanciainscripcion'=>$inscripcion]);
  }

  public function update( Request $request, $id)
  {

    $inscripcion = Inscripcion::findOrFail($id);

    $inscripcion->descripcion=$request->request->get('descripcion');
    $inscripcion->update();
    return Redirect::to('academico/gestionarInscripcion');
  }

  public function destroy($id)
  {
    $inscripcion =Inscripcion::findOrFail($id);
    $detallegradobloque = DetalleGradoBloque::findOrFail($inscripcion->iddetallegradobloque);
    $estudiante = Estudiante::findOrFail($inscripcion->idestudiante);
    $inscripcion->delete();
    $detallegradobloque->cuporestante++;
    $detallegradobloque->update();
    $estudiante->idestado=1;
    $estudiante->update();
    return Redirect::to('academico/gestionarInscripcion');
  }
}
