<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Funcionario extends Authenticatable
{
    protected $connection = "mysql2";

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function roles()
    {
      return $this->belongsToMany('App\Models\Role','funcionario_role','funcionario_id');
    }

    public function hasRole($role){
        $retorno = DB::connection('mysql2')->select("select consulta_role($this->id , 'GESOL', '$role') as retorno");

        if ( $retorno[0]->retorno ){
            return true;
        }
        return false;
    }


    public function relatorios_semsop()
    {
    	return $this->belongsToMany('App\Models\Semsop_relatorio', 'semsop_funcionarios_relatorios')->withPivot('relator')->withTimestamps();
    }

}
