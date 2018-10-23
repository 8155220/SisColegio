<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Http\Requests;
use sistema_colegio\Models\TipoUsuario;
use sistema_colegio\Models\MenuTipoUsuario;
use sistema_colegio\Models\SubMenuTipoUsuario;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Collection;
use DB;
use Session;


class PrivilegiosController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index(Request $request)
  {

      $tipousuario = DB::table('tipousuario')
      ->orderBy('idtipousuario','asc')->paginate(5);
      return view('admUsuario.gestionarPrivilegios.index',["instanciatipousuario"=>$tipousuario]);
  }
  public function create()
  {

       return view('admUsuario.gestionarTipoUsuario.create');
  }

  public function edit($id)
  {
    $menutipousuario = DB::table('menutipousuario')
    ->where('idtipousuario',$id)->get();
    $submenutipousuario = DB::table('submenutipousuario')
    ->where('idtipousuario',$id)->get();
    return view('admUsuario.gestionarPrivilegios.edit',['instanciamenutipousuario'=>$menutipousuario,'instanciasubmenutipousuario'=>$submenutipousuario,'id'=>$id]);
  }
  public function update( Request $request, $id)
  {
    //return $request->all();

      //$request->request->get('estado');
      // funciona return $request->get('estado');;


      $idmenutipousuario = DB::table('menutipousuario')
      ->where('idtipousuario',$id)
      ->where('idmenu',1)
      ->first();
      $idmenu = $idmenutipousuario->idmenutipousuario;
      for ($i=0; $i < 5; $i++) {
        $menutipousuario = MenuTipoUsuario::findOrFail($idmenu+$i);
        $a =$i+1;
        $menutipousuario->estado = $request->get('estado'.$a);
        $menutipousuario->update();
      }
      $idsubmenutipousuario = DB::table('submenutipousuario')
      ->where('idtipousuario',$id)
      ->where('idsubmenu',1)
      ->first();
      $idsubmenu = $idsubmenutipousuario->idsubmenutipousuario;
      for ($i=0; $i < 23; $i++) {
        $submenutipousuario = SubMenuTipoUsuario::findOrFail($idsubmenu+$i);
        $a =$i+1;
        $submenutipousuario->estado = $request->get('estadosubmenu'.$a);
        $submenutipousuario->update();
      }
      Session::flash('message-success','Los cambios fueron guardados exitosamente');


    return Redirect::to('admUsuario/gestionarPrivilegios');
  }

}
