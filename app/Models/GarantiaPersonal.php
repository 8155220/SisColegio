<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class GarantiaPersonal extends Model
{
    protected $table = 'garantiapersonal';
    protected $primaryKey='idgarantiapersonal';
    public $timestamps=false;

    protected $fillable = ["idcliente","idgarante"];


}
