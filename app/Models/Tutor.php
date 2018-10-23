<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
  protected $table='tutor';
  protected $primaryKey= "idtutor";
  public $timestamps=false;

  protected $fillable = [

  "idpersona",
  "idestado"];
  protected $guarded=[];
}
