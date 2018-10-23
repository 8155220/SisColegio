<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDePago extends Model
{
  protected $table='plandepago';
  protected $primaryKey= "idplandepago";
  public $timestamps=false;

  protected $fillable = [

  "idinscripcion",
  "idestado",
  "montototal"];
  protected $guarded=[];
}
