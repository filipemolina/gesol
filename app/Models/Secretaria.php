<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Secretaria extends Model implements AuditableContract
{

    use \OwenIt\Auditing\Auditable;

 	protected $table = "secretarias";

    protected $fillable =[

    	'nome',
        'secretario',
        'sigla',
        'email',
        'telefone',
        'inicio_atendimento',
        'termino_atendimento',
        'operante',
    ];



    public function endereco()
	{
		return $this->hasOne('App\Models\Endereco');
	}

    public function setores()
    {
        return $this->hasMany('App\Models\Setor');
    }


     public function telefones()
    {
        return $this->hasMany('App\Models\Telefone');
    }
}
