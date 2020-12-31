<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Broker extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['id', 'user_id', 'name', 'email', 'password', 'phone', 'active', 'admin' ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function validacao($input, $update = false){
        if($update == false){
            $regras['password']             = 'required|min:6|max:60';
            $regras['password_confirmation'] = 'required|same:password';
        } else{
            $regras = array(
                'name'              => 'required|max:255',
                'email'             => 'required|email|max:255'
            );
        }
        return $regras;
    }

}
