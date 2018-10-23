<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
  protected $table='administrativo';
  protected $primaryKey= "idadministrativo";
  public $timestamps=false;

  protected $fillable = [

  "idpersona",
  "profesion",
  "cargo",
  "idestado"];
  protected $guarded=[];
}
