<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Models\ProgramacionMateria;
use sistema_colegio\Models\DetalleProgramacionMateria;
use sistema_colegio\Models\DetalleProgramacionMateriaPeriodo;
use sistema_colegio\Models\Grado;
use sistema_colegio\Models\Bloque;
use sistema_colegio\Models\Gestion;
use sistema_colegio\Models\Materia;
use sistema_colegio\Models\Docente;
use sistema_colegio\Models\Aula;
use sistema_colegio\Models\Dia;
use sistema_colegio\Models\Periodo;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Session;
use DB;

class ProgramacionMateriaController extends Controller
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

      /*$programacionmateria = DB::table('programacionmateria')
      ->orderBy('idprogramacionmateria','asc')->paginate(6);
      return view('apertura.gestionarProgramacionMateria.index',["instanciaprogramacionmateria"=>$programacionmateria,"searchText"=>$query]);
      */
      $programacionmateria = DB::table('programacionmateria')
      ->select(DB::raw('concat(grado.descripcion," ",bloque.descripcion) as gradocompleto
      ,programacionmateria.iddocente,idprogramacionmateria
      ,materia.descripcion as descripcionmateria
      ,concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno," ",docente.profesion) as nombrecompletodocente'))
      ->join('detallegradobloque','detallegradobloque.iddetallegradobloque','=','programacionmateria.iddetallegradobloque')
      ->join('grado','grado.idgrado','=','detallegradobloque.idgrado')
      ->join('materia','materia.idmateria','=','programacionmateria.idmateria')
      ->join('docente','docente.iddocente','=','programacionmateria.iddocente')
      ->join('persona','persona.ci','=','docente.idpersona')
      ->join('bloque','bloque.idbloque','=','detallegradobloque.idbloque')

      ->paginate(6);
      return view('apertura.gestionarProgramacionMateria.index',["instanciaprogramacionmateria"=>$programacionmateria,"searchText"=>$query]);

    }
  }
  public function create()
  {
       $gestion = Gestion::
       where('idestado','=','1')
       ->first();
       ;

       $turno = DB::table('detallegestionturno')
       ->where('idgestion',$gestion->idgestion)
       ->join('turno','turno.idturno','detallegestionturno.idturno')
       ->pluck('turno.descripcion','iddetallegestionturno');

       //$grado = Grado::pluck('descripcion','idgrado');
       $materia = Materia::
       where('idgestion',$gestion->idgestion)
       ->pluck('descripcion','idmateria');
       $docente = Docente::
       select(DB::raw('concat(persona.nombre," ",persona.apellidopaterno," ",persona.apellidomaterno," ",docente.profesion) as nombrecompleto,iddocente'))
       ->join('persona','docente.idpersona','=','persona.ci')
       ->pluck('nombrecompleto','docente.iddocente');
       $aula = Aula::pluck('descripcion','idaula');
       $dia = Dia::pluck('descripcion','iddia');
       $periodo = Periodo::
       select(DB::raw('concat(periodo.descripcion," ",periodo.horainicio,"-",periodo.horafin," Turno:",turno.descripcion) as detalle,idperiodo'))
       ->join('detallegestionturno','detallegestionturno.iddetallegestionturno','=','periodo.iddetallegestionturno')
       ->join('turno','turno.idturno','=','detallegestionturno.idturno')
       ->pluck('detalle','idperiodo');
       //return view('apertura.gestionarProgramacionMateria.create')->with(['grado',$grado],['gestion',$gestion]);
       return view('apertura.gestionarProgramacionMateria.create',[
         //'grado'=>$grado,
         'gestion'=>$gestion,
         'materia'=>$materia,
         'docente'=>$docente,
         'aula'=>$aula,
         'dia'=>$dia,
         'turno'=>$turno
         ,'periodo'=>$periodo
        ]);
      }
  public function getGrado(Request $request, $id)
  {
    if($request->ajax()){

      $grado = DB::select(DB::raw('select `grado`.`idgrado`, `grado`.`descripcion` from `grado`
      where  grado.idgrado in
      (select idgrado from detallegradobloque where detallegradobloque.iddetallegestionturno='.$id.')'))
      ;
      return response()->json($grado);
    }
  }
  public function getBloque(Request $request, $id, $id2)
  {
    // $id = idgrado ;
    // $id2 = iddetallegestionturno
    if($request->ajax()){
     // $bloque= Bloque::getBloque($id);
     $bloque = DB::select(DB::raw('select `bloque`.`idbloque`, `bloque`.`descripcion` from `bloque`
     where  bloque.idbloque in
     (select idbloque from detallegradobloque where detallegradobloque.iddetallegestionturno='.$id2.'
     and detallegradobloque.idgrado='.$id.')'))
     ;
      return response()->json($bloque);

    }
  }
 /* public function getTurno(Request $request, $id)
  {
    if($request->ajax()){
      $turno= ProgramacionMateria::getTurno($id);
      return response()->json($turno);
     // return "afjasoidfjop";
    }
  }*/

  public function store(Request $request)
  {

    $programacionmateria = new ProgramacionMateria;

    $iddetallegradobloque = DB::table('detallegradobloque')
    ->where('idgrado',$request->get('grado'))
    ->where('idbloque',$request->get('bloque'))
    ->first();
    $programacionmateria->iddetallegestionturno=$request->get('turno');
    $programacionmateria->iddetallegradobloque=$iddetallegradobloque->iddetallegradobloque;
    $programacionmateria->idmateria=$request->get('materia');
    $programacionmateria->iddocente=$request->get('docente');
    $programacionmateria->save();

    $detalleprogramacionmateria = new DetalleProgramacionMateria;
    $detalleprogramacionmateria->idprogramacionmateria=$programacionmateria->idprogramacionmateria;
    $detalleprogramacionmateria->iddia=$request->get('dia');
    $detalleprogramacionmateria->idaula=$request->get('aula');
    $detalleprogramacionmateria->save();

    $detalleprogramacionmateriaperiodo= new DetalleProgramacionMateriaPeriodo;
    $detalleprogramacionmateriaperiodo->iddetalleprogramacionmateria=$detalleprogramacionmateria->iddetalleprogramacionmateria;
    $detalleprogramacionmateriaperiodo->idperiodo=$request->get('periodo');
    $detalleprogramacionmateriaperiodo->save();




    Session::flash('message-success','Los Datos fueron creados exitosamente');
    return Redirect::to('apertura/gestionarProgramacionMateria');
  }

  public function show($id)
  {
    return view("apertura.gestionarProgramacionMateria.show",["instanciaprogramacionmateria"=>programacionmateria::findOrFail($id)]);

  }
  public function edit($id)
  {

    $programacionmateria = DB::table('programacionmateria')->where('idprogramacionmateria',$id)->first();
    return view('apertura.gestionarProgramacionMateria.edit',['instanciaprogramacionmateria'=>$programacionmateria]);
  }
  public function update( Request $request, $id)
  {

    $programacionmateria = ProgramacionMateria::findOrFail($id);
    $programacionmateria->descripcion=$request->request->get('descripcion');
    $programacionmateria->update();
    Session::flash('message-success','Los datos fueron editados correctamente');
    return Redirect::to('apertura/gestionarProgramacionMateria');
  }
  public function destroy($id)
  {
    $programacionmateria =programacionmateria::findOrFail($id);
    $programacionmateria->delete();
    Session::flash('message-error','Datos eliminados correctamente');
    return Redirect::to('apertura/gestionarProgramacionMateria');
  }
}
