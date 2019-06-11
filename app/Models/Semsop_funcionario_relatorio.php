<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Semsop_funcionario_relatorio extends Model // implements AuditableContract
{

  //use \OwenIt\Auditing\Auditable;
  

  protected $table = "semsop_funcionarios_relatorios";

  protected $fillable = [

          	'funcionario_id',
           	'semsop_relatorio_id',
            'relator',
  ];

    
	  public function funcionarios()
 	  {
        return $this->belongsToMany('App\Models\Funcionario');
 	  }
	  

    
    public function relatorios_semsop()
    {
      return $this->belongsToMany('App\Models\Semsop_relatorio');
    }

}
