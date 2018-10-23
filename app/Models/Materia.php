<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materia';
    protected $primaryKey='idmateria';
    public $timestamps=false;

    protected $fillable = ["descripcion"];
}
