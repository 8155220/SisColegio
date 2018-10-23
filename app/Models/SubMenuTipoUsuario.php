<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenuTipoUsuario extends Model
{
    protected $table = 'submenutipousuario';
    protected $primaryKey='idsubmenutipousuario';
    public $timestamps=false;

    protected $fillable = ["idtipousuario","idsubmenu","estado"];
}
