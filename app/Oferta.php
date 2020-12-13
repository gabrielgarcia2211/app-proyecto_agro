<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{

    protected $table = 'ofertas';
    public $timestamps = false;
    protected $fillable = ['empleo', 'jornada','salario','telefono','descripcion','requerimientos','nitemprea'];


}
