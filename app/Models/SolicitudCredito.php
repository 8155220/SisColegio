<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudCredito extends Model
{
  protected $table='solicitudcredito';
  protected $primaryKey= "idsolicitudcredito";
  public $timestamps=false;

  protected $fillable = [

  "idcliente",
  "idtipousuario",
  "montosolicitado",
  "capacidadpago",
  "estado"];
  protected $guarded=[];
}
