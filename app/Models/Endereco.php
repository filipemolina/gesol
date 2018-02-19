<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Endereco extends Model implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;

 	protected $table = "enderecos";

    protected $fillable =[

        'uf',
        'municipio',
        'bairro',
        'logradouro',
        'numero',
        'complemento',
        'cep',
        'latitude',
        'longitude'
 	];


    public function secretaria()
    {
    	return $this->belongsTo('App\Models\Secretaria', 'secretaria_id');
    }

    public function solicitacao()
    {
    	return $this->belongsTo('App\Models\Solicitacao', 'solicitacao_id');
    }

    public function solicitante()
    {
    	return $this->belongsTo('App\Models\Solicitante', 'solicitante_id');
    }

    public function semsop_relatorio()
    {
    	return $this->hasOne('App\Models\Semsop_relatorio', 'endereco_id');
    }


}
