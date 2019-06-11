<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sequencia extends Model
{
    protected $table = "sequencias";
    public $timestamps = false;

    protected $fillable = [
        'numero'
    ];
  
}
