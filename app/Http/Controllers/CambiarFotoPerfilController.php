<?php

namespace sistema_colegio\Http\Controllers;

use Illuminate\Http\Request;
use sistema_colegio\Models\Usuario;
use sistema_colegio\Models\Persona;
use sistema_colegio\Http\Controllers\PersonaController;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Storage;
use Session;
//use Illuminate\Support\Facades\Storage;

use DB;

class CambiarFotoPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function __construct()
       {
         $this->middleware('auth');
       }
    public function index(Request $request)
    {
      $user = Auth::user();
      $persona= Persona::find($user->idpersona);
      //$imagen = $img->imagen;
      return view('perfil.cambiarFotoPerfil.index',['persona'=>$persona]);

    }

    public function update( Request $request)
    {
      $user = Auth::user();
      $persona= Persona::find($user->idpersona);
     // $persona = Persona::findOrFail('8155220');
      $persona->imagen=$persona->ci.'.'.'jpg';
      $persona->update();

      $img=$request->file('imagen');
      $file_route=time().'_'.$img->getClientOriginalName();
      Storage::disk('usersImg')->put($persona->ci.'.'.'jpg',file_get_contents($img->getRealPath()));
      Session::flash('message-success','La imagen fue guardada exitosamente');

      return Redirect::to('perfil/cambiarFotoPerfil');

    }

    public function destroy($id)
    {
      $persona =Persona::findOrFail($id);
      $persona->delete();
      return Redirect::to('admUsuario/gestionarUsuario');
    }
}
