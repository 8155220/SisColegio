<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $table = 'grado';
    protected $primaryKey='idgrado';
    public $timestamps=false;

    protected $fillable = ["descripcion"];
}
