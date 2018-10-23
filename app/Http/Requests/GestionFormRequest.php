<?php

namespace sistema_colegio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GestionFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
      $rules = [];
      if (FormRequest::get('turnotarde')==false &&
          FormRequest::get('turnonoche')==false &&
          FormRequest::get('turnomañana')==false ){
        $rules['turnonoche']='required';
      }
      $rules['descripcion']='required';
      return $rules;
    }
    public function messages()
    {
        return [
            'turnonoche.required' => 'Debe escojer al menos un turno',
            //'body.required'  => 'A message is required',
        ];
    }


}
