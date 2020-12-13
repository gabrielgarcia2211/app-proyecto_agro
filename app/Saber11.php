<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saber11 extends Model
{

    protected $primaryKey = 'idsaber11';
    protected $table = 'saber11s';
    public $timestamps = false;

    protected $fillable = ['idsaber11', 'lectura_critica','matematicas', 'sociales_ciudadanas', 'naturales', 'ingles'];

    public function historial(){
        return $this->belongsTo(Historial::class,'idSaber11');
    }

}
