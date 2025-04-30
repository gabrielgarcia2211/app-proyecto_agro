<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historials';
    protected $primaryKey = 'id';

    protected $fillable = ['idsaberpro', 'idsaber11','documento'];


    public function estudiante(){
        return $this->hasMany(Estudiante::class,'documento', 'documento');
    }
    public function saber11(){
        return $this->hasMany(Saber11::class,'idSaber11', 'idSaber11');
    }
    public function saberpro(){
        return $this->hasMany(SaberPro::class,'idSaberPro', 'idSaberPro');
    }
}
