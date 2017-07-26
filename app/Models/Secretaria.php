<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{

 	protected $table = "secretarias";

    protected $fillable =[

    	'nome',
        'secretario',
        'sigla',
        'email',
        'telefone',
        'inicio_atendimento',
        'termino_atendimento',
    ];



    public function endereco()
	{
		return $this->hasOne('App\Models\Endereco');
	}

    public function setores()
    {
        return $this->hasMany('App\Models\Setor');
    }

	public function funcionarios()
    {
        return $this->hasMany('App\Models\Funcionario');
    }

     public function telefones()
    {
        return $this->hasMany('App\Models\Telefone');
    }
}
