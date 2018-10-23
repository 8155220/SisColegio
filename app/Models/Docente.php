<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
  protected $table='docente';
  protected $primaryKey= "iddocente";
  public $timestamps=false;

  protected $fillable = [

  "idpersona",
  "profesion",
  "idestado"];
  protected $guarded=[];
}
