<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Models\Gestion;
use Illuminate\Support\Facades\Redirect;
use Validator;
use DB;
use Illuminate\Support\Collection;

class ReporteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {
    if($request)
    {
      $gestion = DB::table('gestion')
      ->where('gestion.idestado','1')
      ->first();
      $detallegradobloque = DB::table('detallegradobloque')
      ->select(DB::raw('concat(turno.descripcion," ",grado.descripcion," ",bloque.descripcion) as descripcion,detallegradobloque.iddetallegradobloque'))
      ->join('detallegestionturno','detallegradobloque.iddetallegestionturno','=','detallegestionturno.iddetallegestionturno')
      ->join('turno','detallegestionturno.idturno','=','turno.idturno')
      ->join('grado','detallegradobloque.idgrado','grado.idgrado')
      ->join('bloque','detallegradobloque.idbloque','bloque.idbloque')
      ->get();
      return view('admUsuario.gestionarReporte.index',['instanciadetallegradobloque'=>$detallegradobloque]);
    }
  }
  public function create()
  {

       return view('admUsuario.gestionarTipoUsuario.create');
  }

  public function getReporteGestion()
  {
    $gestion = DB::table('gestion')
    ->where('gestion.idestado','1')
    ->first();
    $turno = DB::table('detallegestionturno')
    ->select('turno.descripcion','detallegestionturno.iddetallegestionturno')
    ->join('turno','detallegestionturno.idturno','=','turno.idturno')
    ->where('detallegestionturno.idgestion',$gestion->idgestion)->get();
    $grado = DB::table('grado')
    ->where('idgestion',$gestion->idgestion)->get();
    $bloque = DB::table('bloque')
    ->where('idgestion',$gestion->idgestion)->get();
    $materia = DB::table('materia')
    ->where('idgestion',$gestion->idgestion)->get();

    $cantidadinscritos = DB::select(DB::raw('select sum(cupototal-cuporestante) as cupo
    from detallegradobloque where iddetallegestionturno in
          (select iddetallegestionturno from detallegestionturno where idgestion='.$gestion->idgestion.')'))
          ;
    $pdf = \PDF::loadView('admUsuario.gestionarReporte.gestion',[
      'instanciagestion'=>$gestion,
      'instanciaturno'=>$turno,
      'instanciagrado'=>$grado,
      'instanciabloque'=>$bloque,
      'instanciamateria'=>$materia,
      'cantidadinscritos'=>$cantidadinscritos,
    ]);
    return $pdf->stream();
  }
  public function getReporteGrado($id)
  {
    $gestion = DB::table('gestion')
    ->where('gestion.idestado','1')
    ->first();

    $detallegradobloque = DB::table('detallegradobloque')
    ->select(DB::raw('concat(grado.descripcion," ",bloque.descripcion) as descripcion'))
    ->join('grado','detallegradobloque.idgrado','=','grado.idgrado')
    ->join('bloque','detallegradobloque.idbloque','=','bloque.idbloque')
    ->where('detallegradobloque.iddetallegradobloque',$id)->first();

    $estudiante = DB::table('inscripcion')
    ->select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno) as descripcionestudiante , estudiante.rude'))
    ->join('estudiante','inscripcion.idestudiante','=','estudiante.idestudiante')
    ->join('persona','estudiante.idpersona','=','persona.ci')
    ->where('inscripcion.iddetallegradobloque',$id)
    ->get();
    $pdf = \PDF::loadView('admUsuario.gestionarReporte.grado',[
      'instanciadetallegradobloque'=>$detallegradobloque,
      'instanciaestudiante'=>$estudiante,

    ]);
    return $pdf->stream();
  }






  public function update( Request $request, $id)
  {

    $tipousuario = TipoUsuario::findOrFail($id);

    $tipousuario->descripcion=$request->request->get('descripcion');
    $tipousuario->update();
    return Redirect::to('admUsuario/gestionarTipoUsuario');
  }

  public function destroy($id)
  {
    $tipousuario =TipoUsuario::findOrFail($id);
    $tipousuario->delete();
    return Redirect::to('admUsuario/gestionarTipoUsuario');
  }
}
