<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tesis_Estudiante extends Model
{
    protected $table = 'tesis__estudiantes';
    protected $primaryKey = 'id';

    protected $fillable = ['id_tesis', 'codigoestudiante'];

    public function tesis(){
        return $this->hasMany(Tesis::class,'codigo','id_tesis');
    }

    public function usuario(){
        return $this->hasMany(User::class,'codigo','codigoEstudiante');
    }
}
