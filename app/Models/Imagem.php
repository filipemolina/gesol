<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Imagem extends Model implements AuditableContract
{
   use \OwenIt\Auditing\Auditable;

  protected $table = "imagens";


protected $fillable = [

          	'imagem',
           
  ];

}
