<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiantes';

    protected $fillable = ['documento','egresado', 'semestrecursado','materiasaprobadas','promedio', 'fechaingreso','fechaegreso','id_historial'];



    public function persona(){
        return $this->hasOne(Persona::class,'documento', 'documento');
    }
    public function user(){
        return $this->belongsTo(User::class,'documento');

    }


    public function historial(){
        return $this->belongsTo(Historial::class,'documento');
    }
}
