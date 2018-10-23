<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
  protected $table='cuota';
  protected $primaryKey= "idcuota";
  public $timestamps=false;

  protected $fillable = [

  "idplandepago",
  "numerocuota",
  "monto",
  "idestado"];
  protected $guarded=[];
}
