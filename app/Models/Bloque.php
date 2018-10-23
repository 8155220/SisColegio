<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;
use sistema_colegio\Models\DetalleGradoBloque;

class Bloque extends Model
{
    protected $table = 'bloque';
    protected $primaryKey='idbloque';
    public $timestamps=false;

    protected $fillable = ["descripcion"];

    public static function getBloque($id)//iddetallegradobloque
    {
      return
      DetalleGradoBloque::
      where('idgrado','=',$id)
      ->join('bloque','bloque.idbloque','=','detallegradobloque.idbloque')
      ->get();

    }
}
