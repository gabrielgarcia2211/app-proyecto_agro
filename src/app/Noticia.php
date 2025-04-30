<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticia';
    public $timestamps = false;

    protected $fillable = ['titulo','autor', 'noticia','envio'];
}
