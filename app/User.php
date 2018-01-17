<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\enviaEmaildeDefinicaodeSenha;

class User extends Authenticatable
{
    // use HasApiTokens, Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'name', 'email', 'password', 'solicitante_id', 'fcm_id'
    // ];

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // // Relacionamentos

    // public function funcionario()
    // {
    //     return $this->belongsTo('App\Models\Funcionario');
    // }

    // public function solicitante()
    // {
    //     return $this->belongsTo('App\Models\Solicitante');
    // }
    
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new enviaEmaildeDefinicaodeSenha($token));
    // }    
}
