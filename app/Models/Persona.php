<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Persona extends Model
{
    protected $table='persona';
    protected $primaryKey= "ci";
    public $timestamps=false;

    protected $fillable = [
    "ci",
    "nombre",
    "apellidopaterno",
    "apellidomaterno",
    "fechanacimiento",
    "sexo",
    "imagen"];
    protected $guarded=[];
    public function setPathAttribute($path)
    {
      $this->attributes['path']=Carbon::now()->second.$path->getClientOriginalName();
      $name=Carbon::now()->second.$path->getClientOriginalName();
      \Storage::disk('local')->put($name,\File::get($path));

    }
}
