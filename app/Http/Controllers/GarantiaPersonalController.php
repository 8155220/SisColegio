<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Models\GarantiaPersonal;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Collection;
use DB;

class GarantiaPersonalController extends Controller
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
      $garantiapersonal = DB::table('garantiapersonal')
      ->where('garantiapersonal.idcliente','LIKE','%'.$query.'%')
      ->paginate(5);

     return view('admCredito.gestionarGarantiaPersonal.index',["instanciagarantiapersonal"=>$garantiapersonal,"searchText"=>$query]);

    }
  }

  public function create()
  {

       return view('admCredito.gestionarGarantiaPersonal.create');
  }

  public function store(Request $request)
  {

    $garantiapersonal = new garantiapersonal;

    $garantiapersonal->descripcion=$request->get('descripcion');
    $garantiapersonal->save();
    return Redirect::to('admUsuario/gestionargarantiapersonal');
  }


  public function show($id)
  {
    return view("admUsuario.gestionargarantiapersonal.show",["instanciagarantiapersonal"=>garantiapersonal::findOrFail($id)]);

  }

  public function edit($id)
  {

    $garantiapersonal = DB::table('garantiapersonal')->where('idgarantiapersonal',$id)->first();
    return view('admCredito.gestionarGarantiaPersonal.edit',['instanciagarantiapersonal'=>$garantiapersonal]);
  }

  public function update( Request $request, $id)
  {

    $garantiapersonal = garantiapersonal::findOrFail($id);

    $garantiapersonal->descripcion=$request->request->get('descripcion');
    $garantiapersonal->update();
    return Redirect::to('admUsuario/gestionargarantiapersonal');
  }


  public function destroy($id)
  {
    $garantiapersonal =garantiapersonal::findOrFail($id);
    $garantiapersonal->delete();
    return Redirect::to('admCredito/gestionarGarantiaPersonal');
  }
}
