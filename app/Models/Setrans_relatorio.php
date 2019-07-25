<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Setrans_relatorio extends Model
{
    protected $table = "setrans_relatorios";
    public $timestamps = false;
    
    protected $fillable = [
        'data',
        'hora',
        'registro_ocorrencia',
        'outros',
        'cones',
        'bombonas',
        'radios',
        'placas',
        'lanternas',
        'enviado'
    ];

    public function funcionarios()
    {
       return $this->belongsToMany(Funcionario::class, env('mysql2').'gesol.setrans_funcionarios_relatorios')->withPivot('relator');
    }

    public function imagens()
    {
      return $this->belongsToMany('App\Models\Imagem', 'imagens_setrans_relatorios', 'setrans_relatorio_id', 'imagem_id');
    }


}
