<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    public $timestamps = false;

    protected $fillable = ['titulo','direccion', 'fecha','hora','responsable', 'ciudad','descripcion','destinatario','foto'];
}
