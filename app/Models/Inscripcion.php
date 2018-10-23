<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripcion';
    protected $primaryKey='idinscripcion';
    public $timestamps=false;

    protected $fillable = ["idadministrativo,idestudiante,iddetallegradobloque,iddetallegestionturno,fecha"];
}
