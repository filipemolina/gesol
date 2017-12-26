<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FCM_Token extends Model
{
    protected $table = "f_c_m__tokens";

    protected $fillable = [
    	'token',
    	'navegador',
    	'versao',
    	'plataforma',
    	'user_id'
    ];

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id');
    }
}
