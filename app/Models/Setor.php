<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Setor extends Model implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;
    
    protected $table = "setores";

    protected $fillable =[
    	'nome',
        'oculto',
        'icone',
        'cor',
        'secretaria_id',
        'operante',
    ];


    public function funcionarios()
    {
        return $this->hasMany('App\Models\Funcionario');
    }

    public function secretaria()
    {
    	return $this->belongsTo('App\Models\Secretaria');
    }

	public function servicos()
    {
        return $this->hasMany('App\Models\Servico');
    }

    public function telefones()
    {
        return $this->hasMany('App\Models\Telefone');
    }

}
