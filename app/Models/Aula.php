<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aula';
    protected $primaryKey='idaula';
    public $timestamps=false;

    protected $fillable = ["descripcion"];
}
