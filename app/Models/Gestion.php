<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Gestion extends Model
{
    protected $table = 'gestion';
    protected $primaryKey='idgestion';
    public $timestamps=false;

    protected $fillable = ["descripcion,fechainicio,fechafin"];

    public static function getGestion()
    {
      $gestion= DB::table('gestion')
      ->where('idestado','=',1)->first();
      return $gestion->idgestion;
    }
}
