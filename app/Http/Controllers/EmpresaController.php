<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\Persona;
use sistema_colegio\Models\User;
use sistema_colegio\Models\Empresa;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use Storage;

use DB;

class EmpresaController extends Controller
{

       public function __construct()
       {
         $this->middleware('auth');
       }
    public function index()
    {
        $empresa = DB::table('html')
        ->paginate(23);
        return view('admEmpresa.gestionarEmpresa.index',["instanciaempresa"=>$empresa]);
    }
    public function edit($id)
    {
      $empresa = DB::table('html')
      ->where('idhtml',$id)->first();
      return view('admEmpresa.gestionarEmpresa.edit',['instanciaempresa'=>$empresa]);
    }

    public function update( Request $request, $id)
    {
      $html = Empresa::findOrFail($id);
      if($html->tipohtml=='etiqueta')
      {
      $html->descripcion=$request->get('descripcion');
      $html->update();
      Session::flash('message-success','Cambios guardados con exito');
      return Redirect::to('admEmpresa/gestionarEmpresa');
      }
      else
      {
      /*$html->descripcion=$request->get('descripcion');
      $html->update();
      $user = Auth::user();
      $persona= Persona::find($user->idpersona);
     // $persona = Persona::findOrFail('8155220');
      $persona->imagen=$persona->ci.'.'.'jpg';
      $persona->update();*/

      $img=$request->file('imagen');
      $file_route=time().'_'.$img->getClientOriginalName();
      Storage::disk('imagenes')->put($html->tipohtml.'.'.'jpg',file_get_contents($img->getRealPath()));
      Session::flash('message-success','La imagen fue guardada exitosamente');

      return Redirect::to('admEmpresa/gestionarEmpresa');
      }

    }
}
