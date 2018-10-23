<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  protected $table='users';
  protected $primaryKey= "id";
  public $timestamps=false;

  protected $fillable = [

  "email",
  "password",
  "tipousuario",
  "idpersona"];
  protected $guarded=[];
}
