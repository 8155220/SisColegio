<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
  protected $table='html';
  protected $primaryKey= "idhtml";
  public $timestamps=false;

  protected $fillable = [

  "tipohtml",
  "descripcion",
  "numerocuota"];
  protected $guarded=[];
}
