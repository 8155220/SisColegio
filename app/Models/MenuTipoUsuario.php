<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class MenuTipoUsuario extends Model
{
    protected $table = 'menutipousuario';
    protected $primaryKey='idmenutipousuario';
    public $timestamps=false;

    protected $fillable = ["idtipousuario","idmenu"];
}
