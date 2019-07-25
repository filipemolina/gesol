<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Setrans_funcionarios_relatorio extends Model
{
    protected $table = "setrans_funcionarios_relatorios";

    protected $fillable = [
        'funcionario_id',
        'setrans_relatorio_id',
        'relator',
    ];

    public function funcionarios()
 	  {
        return $this->belongsToMany('App\Models\Funcionario');
 	  }
	  

    
    public function relatorios_setrans()
    {
      return $this->belongsToMany('App\Models\Setrans_relatorio');
    }

}
