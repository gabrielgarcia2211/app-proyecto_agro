<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa_Estudiante extends Model
{

    protected $table = 'empresa__estudiantes';
    protected $fillable = ['nitemprea', 'codigoestudiante'];
}
