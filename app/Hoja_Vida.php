<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hoja_Vida extends Model
{

    protected $table = 'hoja__vidas';
    public $timestamps = false;

    protected $fillable = ['codigo', 'archivo','autorizar'];


}
