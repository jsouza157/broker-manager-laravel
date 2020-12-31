<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company', 'site', 'name', 'email', 'api_token', 'trial', 'payment_date', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function validacao($input, $update = false){
        
        if(isset($update) == false || $update == false){
            $regras['password']             = 'required|min:6|max:60';
            $regras['password_confirmation'] = 'required|same:password';
        } else{
            $regras = array(
                'company'           => 'required|max:255',
                'site'              => 'max:255',
                'name'              => 'required|max:255',
                'email'             => 'required|email|max:255'
            );
        }
        return $regras;
    }

}
