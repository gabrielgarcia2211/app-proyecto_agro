<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'documento';

    protected $fillable = ['documento','nombres', 'apellidos', 'celular', 'correo', 'telefono', 'tipo_documento', 'direccion'];


    public function estudiante(){
        return $this->belongsTo(Estudiante::class,'documento');
    }

    public function user(){
        return $this->belongsTo(User::class,'documento');
    }
}
