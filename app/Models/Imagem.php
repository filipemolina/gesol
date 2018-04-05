<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Imagem extends Model implements AuditableContract
{
   use \OwenIt\Auditing\Auditable;

  protected $table = "imagens";
				
				protected $fillable = [
				'imagem'
				];

  // Relacionamentos

	public function semsop_relatorios()
	{
	  return $this->belongsToMany('App\Models\Semsop_relatorio', 'imagens_semsop_relatorios', 'imagem_id', 'semsop_relatorio_id');
	}

}
