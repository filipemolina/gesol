<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Solicitacao extends Model implements AuditableContract
{

   use \OwenIt\Auditing\Auditable;

   protected $table = "solicitacoes";

   protected $dates = [
        'created_at',
        'updated_at'
   ];

    protected $fillable =[
		'foto',
        'conteudo',
        'status',
        'moderado',
        'prioridade',
        'servico_id',
        'prazo'
    ];

    protected $auditExclude = [
        'foto'
    ];


    public function servico()
    {
        return $this->belongsTo('App\Models\Servico');
    }

    public function solicitante()
    {
        return $this->belongsTo('App\Models\Solicitante');
    }

    public function enderecos()
    {
        return $this->hasMany('App\Models\Endereco');
    }

    public function endereco()
    {
        return $this->hasOne('App\Models\Endereco');
    }


    public function comentarios()
    {
        return $this->hasMany('App\Models\Comentario');
    }

    public function apoiadores()
    {
        return $this->belongsToMany('App\Models\Solicitante', 'apoios');
    }

    public function movimentos()
    {
        return $this->hasMany('App\Models\movimento');
    }    
}
