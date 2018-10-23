<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleGestionTurno extends Model
{
    protected $table = 'detallegestionturno';
    protected $primaryKey='iddetallegestionturno';
    public $timestamps=false;

    protected $fillable = ["idgestion,idturno"];
}
