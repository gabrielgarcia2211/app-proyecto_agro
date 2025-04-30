<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rols';
    protected $primaryKey = 'id';


    public function user(){
        return $this->belongsTo(User::class,'id');
    }
}
