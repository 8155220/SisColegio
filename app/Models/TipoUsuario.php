<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipousuario';
    protected $primaryKey='idtipousuario';
    public $timestamps=false;

    protected $fillable = ["idtipousuario","descripcion"];
}
