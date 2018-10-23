<?php

namespace sistema_colegio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscripcionFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
   //  $rules = [];
     // if($this->get('cuporestante')=="0")
    //    $rules['cuporestante']='required';
       //$rules['cuporestante']='required';
      return [
          'cuporestante'=>'required|not_in:0',
          'iddetallegestionturno'=>'required',
          'idgrado'=>'required|not_in:placeholder,seleccionar',
          'idbloque'=>'required|not_in:placeholder,seleccionar',
          'idestudiante'=>'required'
      ];
     // return $rules;
    }
    public function messages()
    {
        return [
            'cuporestante.required' => 'Tiene que verificar cupo',
            'cuporestante.not_in:0'=> 'Cupo insuficiente',
            'iddetallegestionturno.required'=>'Tiene que seleccionar un Turno',
            'idgrado.not_in'=>'Tiene que seleccionar un Grado',
            'idbloque.not_in'=>'Tiene que seleccionar un Bloque',
            'idestudiante.required'=>'Al parecer no existen estudiante habilitados para inscripcion'
            //'body.required'  => 'A message is required',
        ];
    }
}
