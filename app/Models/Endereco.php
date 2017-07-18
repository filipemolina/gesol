<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
 	protected $table = "enderecos";

    protected $fillable =[

		'uf',
        'municipio',
        'bairro',
        'logradouro',
        'numero',
        'complemento',
        'cep',
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


}
