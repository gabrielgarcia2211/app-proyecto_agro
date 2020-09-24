<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';
    protected $primaryKey = 'documento';

    protected $fillable = ['documento', 'codigoEstudiante','egresado', 'semestreCursado','materiasAprobadas','promedio', 'fechaIngreso','fechaEgreso','id_historial'];



    public function user(){
        return $this->hasOne(Persona::class,'documento', 'documento');
    }

    public function historial(){
        return $this->belongsTo(Historial::class,'documento');
    }
}
