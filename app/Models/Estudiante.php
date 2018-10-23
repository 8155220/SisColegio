<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
  protected $table='estudiante';
  protected $primaryKey= "idestudiante";
  public $timestamps=false;

  protected $fillable = [

  "idpersona",
  "rude",
  "idtutor",
  "idestado"];
  protected $guarded=[];
}
