<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class Dia extends Model
{
    protected $table = 'dia';
    protected $primaryKey='iddia';
    public $timestamps=false;

    protected $fillable = ["descripcion"];
}
