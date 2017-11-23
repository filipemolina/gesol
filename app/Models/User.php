<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'solicitante_id','avatar','role_id','status'
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

}
