<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
 	protected $table = "solicitantes";

    protected $fillable =[
	 	'nome',
        'email',
        'fb_uid',
        'fb_token',
        'celular',
        'sexo',
        'telefone',
        'foto',
        'status',
        'mulher_responsavel',
        'renda_familiar',
        'tempo_residencia',
        'necessidades_especiais',
        'tipo_deficiencia',
        'nis',
        'ctps',
        'bolsa_familia',
        'vr_bolsa',
        'codigo_inscricao',
        'titulo',
        'indicacao_politica',
        'cpf',
        'identidade',
        'emissao_idt',
        'orgao_emissor_idt',
        'titulo_eleitor',
        'emissao_titulo',
        'zona_eleitoral',
        'nascimento',
        'naturalidade',
        'nacionalidade',
        'pai',
        'mae',
        'estado_civil',
        'profissao',
        'escolaridade',
    ];


    public function endereco()
	{
		return $this->hasOne('App\Models\Endereco');
	}

    public function telefones()
    {
        return $this->hasMany('App\Models\Telefone');
    }

	public function solicitacoes()
    {
        return $this->hasMany('App\Models\Solicitacao');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
