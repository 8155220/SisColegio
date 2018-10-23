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


class SucursalController extends Controller
{
  public function index(Request $request)
  {
    if($request)
    {
      $query=trim($request->get('searchText'));
      $sucursal = DB::table('sucursal')
      ->where('descripcion','LIKE','%'.$query.'%')
      ->orderBy('sucursal.idsucursal','asc')->paginate(6);

      return view('admCredito.gestionarSucursal.index',["instanciasucursal"=>$sucursal,"searchText"=>$query]);
    }
  }


  public function edit($id)
  {

    $sucursal = DB::table('sucursal')
    ->where('idsucursal',$id)
    ->get();
    return view('admCredito.gestionarSucursal.edit',['instanciasucursal'=>$sucursal]);
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
      for ($i=0; $i < 4; $i++) {
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
      for ($i=0; $i < 17; $i++) {
        $submenutipousuario = SubMenuTipoUsuario::findOrFail($idsubmenu+$i);
        $a =$i+1;
        $submenutipousuario->estado = $request->get('estadosubmenu'.$a);
        $submenutipousuario->update();
      }
      Session::flash('message-success','Los cambios fueron guardados exitosamente');


    return Redirect::to('admUsuario/gestionarPrivilegios');
  }

}
