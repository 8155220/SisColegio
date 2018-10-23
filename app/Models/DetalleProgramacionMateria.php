<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleProgramacionMateria extends Model
{
    protected $table = 'detalleprogramacionmateria';
    protected $primaryKey='iddetalleprogramacionmateria';
    public $timestamps=false;

    protected $fillable = ["iddetalleprogramacionmateria,iddia,idaula"];
}
