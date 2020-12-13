<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    protected $table = 'teses';
    protected $primaryKey = 'codigo';
    public $timestamps = false;

    protected $fillable = ['codigo', 'archivo', 'titulo'];

   public function historial(){
      return $this->belongsTo(Historial::class,'codigo');
   }

}
