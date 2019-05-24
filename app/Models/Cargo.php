<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Cargo extends Model implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;

    protected $table = "cargos";


    protected $fillable = [
    	'nome',
		'tipo',
		'secretaria_id'
    ];

    public function funcionarios()
    {
        return $this->hasMany('App\Models\Funcionario');
    }
    
    public function secretaria()
    {
    	return $this->belongsTo('App\Models\Secretaria','secretaria_id');
    }
}



