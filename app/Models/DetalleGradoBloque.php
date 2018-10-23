<?php

namespace sistema_colegio\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleGradoBloque extends Model
{
    protected $table = 'detallegradobloque';
    protected $primaryKey='iddetallegradobloque';
    public $timestamps=false;
    protected $fillable = ["idgrado,idbloque,cupototal,cuporestante"];
}
