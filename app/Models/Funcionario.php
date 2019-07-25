<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Funcionario extends Authenticatable
{
    protected $connection = "mysql2";

     protected $fillable = [
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


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
        //return $this->belongsToMany('App\Models\Semsop_relatorio', env('mysql2').'gesol.semsop_funcionarios_relatorios')->withPivot('relator');
        return $this->belongsToMany('App\Models\Semsop_relatorio', 'semsop_funcionarios_relatorios')->withPivot('relator')->withTimestamps();
        
        //return DB::connection('mysql')->table('semsop_funcionarios_relatorios')->where('funcionario_id', $this->id)->get();
        
       
        //ESSE AQUI
        //return $this->belongsToMany(Semsop_relatorio::class , env('mysql').'gesol.semsop_funcionarios_relatorios')->withPivot('relator');
       
       
       //return $this->belongsToMany(Funcionario::class, env('mysql2').'gesol.semsop_funcionarios_relatorios')->withPivot('relator');

    }

    public function relatorios_setrans()
    {
        return $this->belongsToMany('App\Models\Setrans_relatorio', 'setrans_funcionarios_relatorios')->withPivot('relator')->withTimestamps();  

    }

}
