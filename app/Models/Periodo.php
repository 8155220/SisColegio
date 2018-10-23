<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = 'periodo';
    protected $primaryKey='idperiodo';
    public $timestamps=false;

    protected $fillable = ["idturno,descripcion,horainicio,horafin"];
}
