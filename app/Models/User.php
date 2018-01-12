<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\enviaEmaildeDefinicaodeSenha;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'solicitante_id','avatar','role_id','status', 'fcm_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relacionamentos

    public function funcionario()
    {
        return $this->belongsTo('App\Models\Funcionario');
    }

    public function solicitante()
    {
        return $this->belongsTo('App\Models\Solicitante');
    }

    public function fcm_tokens(){
        return $this->hasMany('App\Models\FCM_Token');
    }

}
