<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $primaryKey = 'nit';
    protected $table = 'empresas';

    protected $fillable = ['nit', 'nombre','telefono','correo','celular' ,'direccion','ciudad', 'contraseña','convenio','fecha'];

    public function users(){
        return $this->belongsTo(User::class,'nit');
    }
}
