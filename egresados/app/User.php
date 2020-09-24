<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'codigo';
    protected $table = 'users';

    protected $fillable = ['codigo', 'documento','email','email_verified_at' ,'password','remember_token', 'rol'];


    public function role(){
        return $this->hasOne(Role::class,'id','rol');
    }

    public function estudiante(){
        return $this->belongsTo(Estudiante::class,'documento');
    }


    public function persona(){
        return $this->hasOne(Persona::class,'documento','documento');
    }

}
