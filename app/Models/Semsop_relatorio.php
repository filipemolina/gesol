<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Semsop_relatorio extends Model // implements AuditableContract
{

  //use \OwenIt\Auditing\Auditable;
  

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
            'acoes_gerente',
            'tipo',                    
            'relato',
          	'providencia',
            'foto',
            'data',
            'hora',
            'enviado',
  ];

    public function endereco()
    {
        return $this->belongsTo('App\Models\Endereco');
    }
    
    public function funcionarios()
    {

       //return $this->belongsToMany('App\Models\Funcionario','semsop_funcionarios_relatorios')->withPivot('relator')->withTimestamps();

        //return $this->belongsToMany(Funcionario::class, env('mysql').'gesol.semsop_funcionarios_relatorios', 'funcionario_id', 'semsop_relatorio_id')->withPivot('relator');
       
       //ESSE AQUI
       return $this->belongsToMany(Funcionario::class, env('mysql2').'gesol.semsop_funcionarios_relatorios')->withPivot('relator');
        
       
       
       //return $this->belongsToMany(Semsop_relatorio::class, env('mysql').'gesol.semsop_funcionarios_relatorios', 'funcionario_id', 'semsop_relatorio_id')->withPivot('relator');
    }

    public function imagens()
    {
      return $this->belongsToMany('App\Models\Imagem', 'imagens_semsop_relatorios', 'semsop_relatorio_id', 'imagem_id');
    }

}
