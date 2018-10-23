<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
  protected $table='credito';
  protected $primaryKey= "idcredito";
  public $timestamps=false;

  protected $fillable = [

  "idsolicitudcredito",
  "meses",
  "estado"];
  protected $guarded=[];
}
