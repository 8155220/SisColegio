<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\Cuota;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use PDF;
use DB;

class CuotaController extends Controller
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
        $cuota = DB::table('cuota')
       // ->where('idestudiante','LIKE','%'.$query.'%')
       ->select(DB::raw('concat(persona.nombre,persona.apellidopaterno,persona.apellidomaterno) as nombrecompleto, estado.descripcion as descripcionestado ,cuota.idcuota,plandepago.idplandepago,plandepago.idestudiante,cuota.monto,cuota.idestado,cuota.numerocuota'))
       ->join('plandepago','plandepago.idplandepago','=','cuota.idplandepago')
       ->join('estudiante','plandepago.idestudiante','=','estudiante.idestudiante')
       ->join('persona','persona.ci','=','estudiante.idpersona')
       ->join('estado','estado.idestado','=','cuota.idestado')
       ->simplePaginate(20);
        return view('academico.gestionarCuota.index',["instanciacuota"=>$cuota,"searchText"=>$query]);
      }
    }

    public function edit($id)
    {

      $cuota = DB::table('cuota')
      ->where('idcuota',$id)->first();
      return view('academico.gestionarCuota.edit',['instanciacuota'=>$cuota]);

    }

    public function update( Request $request, $id)
    {
      $cuota = Cuota::findOrFail($id);
      $cuota->idestado=$request->get('estado');
      $cuota->update();
      Session::flash('message-success','Los cambios fueron guardados exitosamente');
      return Redirect::to('academico/gestionarCuota');
    }
    public function show($id)
    {
      //return view("inscripcion.estudiante.show",["estudiante"=>Estudiante::findOrFail($id)->toJson()]);
      /*
      $pdf = PDF::loadHTML('<h1>Test</h1>');
      return $pdf->stream();*/
      $data = [1,2,3];
      $pdf = \PDF::loadView('academico.gestionarCuota.index2',$data);
      return $pdf->stream();
    }
}
