<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Comunicado extends Model implements AuditableContract
{
    use \OwenIt\Auditing\Auditable;

    // Campos liberados para preenchimento via formulário
    protected $fillable = [
    	'imagem',
    	'titulo',
    	'subtitulo',
    	'texto',
    	'funcionario_id'
    ];

    public function funcionario()
    {
    	return $this->belongsTo('App\Models\Funcionario', 'funcionario_id');
    }
}
