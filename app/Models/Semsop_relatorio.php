<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Semsop_relatorio extends Model implements AuditableContract
{

  use \OwenIt\Auditing\Auditable;

  protected $table = "semsop_relatorios";

  protected $fillable = [

          	'notificacao',
           	'autuacao',
            'multa',
            'registro_dp',            
            'auto_pf',                
            'envolvidos',
            'origem',
          	'acao_gcmm',
            'acao_cop',
            'tipo',                    
            'relato',
          	'providencia',
            'foto',
            'data',
            'hora',
  ];

    public function endereco()
    {
        return $this->belongsTo('App\Models\Endereco');
    }
    
    public function funcionarios()
    {
    	return $this->belongsToMany('App\Models\Funcionario','semsop_funcionarios_relatorios')->withTimestamps();
    }


}
