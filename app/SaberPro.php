<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaberPro extends Model
{
    protected $primaryKey = 'idsaberpro';
    protected $table = 'saber_pros';
    public $timestamps = false;

    protected $fillable = ['idsaberpro', 'lectura_critica','razonamiento_cuantitativo', 'competencias_ciudadana', 'comunicacion_escrita', 'ingles'];

    public function historial(){
        return $this->belongsTo(Historial::class,'idSaberPro');
    }
}
