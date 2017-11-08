<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    // Fillables

    protected $fillable = [
    	'cpf',
        'nome',
    	'matricula',
    	'cargo',
    	'foto',
        'acesso',
        'role_id',
        'setor_id'
    ];

    // Relacionamentos

    public function setor()
    {
    	return $this->belongsTo('App\Models\Setor');
    }

    public function user()
    {
    	return $this->hasOne('App\User');
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
