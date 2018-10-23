<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleProgramacionMateriaPeriodo extends Model
{
    protected $table = 'detalleprogramacionmateriaperiodo';
    protected $primaryKey='iddetalleprogramacionmateriaperiodo';
    public $timestamps=false;

    protected $fillable = ["iddetalleprogramacionmateria,idperiodo"];
}
