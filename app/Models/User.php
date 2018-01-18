<?php

namespace App\Models;


use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\UserResolver;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\enviaEmaildeDefinicaodeSenha;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable, UserResolver
{
    use HasApiTokens, Notifiable, \OwenIt\Auditing\Auditable;

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new enviaEmaildeDefinicaodeSenha($token));
    }

    /**
    *   Método estático necessário para o plugin de auditoria
    */

    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }
}
