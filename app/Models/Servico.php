<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Servico extends Model implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;
    
	protected $table = "servicos";

    protected $fillable =[
        'nome',
        'prazo',
        'operante',
        'setor_id',

    ];


    public function setor()
    {
    	return $this->belongsTo('App\Models\Setor');
    }

	public function solicitacoes()
    {
        return $this->hasMany('App\Models\Solicitacao');
    }


       
}
