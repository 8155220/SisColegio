<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;
use sistema_colegio\Models\DetalleGradoBloque;
use sistema_colegio\Models\DetalleGestionTurno;


class ProgramacionMateria extends Model
{
    protected $table = 'programacionmateria';
    protected $primaryKey='idprogramacionmateria';
    public $timestamps=false;

    protected $fillable = ["iddetallebloque,idmateria,iddocente,iddetallegestionturno"];
    public static function getBloque($id)
    {
      return
      DetalleGradoBloque::
      where('idgrado','=',$id)
      ->join('bloque','bloque.idbloque','=','detallegradobloque.idbloque')
      ->get();

    }
    public static function getTurno($id)
    {
      return
      DetalleGestionTurno::
      where('idgestion','=',$id)
      ->join('turno','turno.idturno','=','DetalleGestionTurno.idturno')
      ->get();
    }
}
