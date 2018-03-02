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
    	'foto',
        'setor_id',
        'role_id',
        'cargo_id',
        'tipo'
        
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

    public function cargo()
    {
        return $this->belongsTo('App\Models\Cargo','cargo_id');
    }

    public function sys_logs()
    {
        return $this->hasMany('App\Models\Sys_log');
    }        

    public function role()
    {
      return $this->belongsTo('App\Models\Role');
    }

    public function atribuicoes()
    {
      return $this->belongsToMany('App\Models\Atribuicao', 'atribuicao_funcionario');
    }
   
    public function relatorios_semsop()
    {
    	return $this->belongsToMany('App\Models\Semsop_relatorio', 'semsop_relatorio_id');
    }



}
