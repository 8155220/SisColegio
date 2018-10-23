<?php

namespace sisColegio\Http\Controllers;

use Illuminate\Http\Request;

use sistema_colegio\Http\Requests;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {

       $persona = new Persona;
       $persona->nombre=$request->get('nombre');
       $persona->apellidopaterno=$request->get('apellidopaterno');
       $persona->apellidomaterno=$request->get('apellidomaterno');
       $persona->ci=$request->get('ci');
       //$estudiante->fechaNacimiento=$request->get('fechaNacimiento');
       $persona->sexo=$request->get('sexo');
       $persona->imagen=$request->get('imagen');
       $persona->direccion=$request->get('direccion');

       $persona->save();
       //return Redirect::to('inscripcion/estudiante');
     }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
