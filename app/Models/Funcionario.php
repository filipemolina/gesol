<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Funcionario extends Model implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;

    // Fillables

    protected $fillable = [
    	
        'nome',
        'cpf',
    	'matricula',
    	'cargo',
    	'foto',
        'setor_id',
        'role_id',
        
    ];

    // Relacionamentos

    public function setor()
    {
    	return $this->belongsTo('App\Models\Setor');
    }

    public function user()
    {
    	return $this->hasOne('App\Models\User');
    }

    public function comentarios()
    {
        return $this->hasMany('App\Models\Comentario');
    }
    
    public function movimentos()
    {
        return $this->hasMany('App\Models\Movimento');
    }        

    public function sys_logs()
    {
        return $this->hasMany('App\Models\Sys_log');
    }        

    public function role()
    {
      return $this->belongsTo('App\Models\Role');
    }
   
}
