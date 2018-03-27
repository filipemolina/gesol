<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // Retorna a versão atual do aplicativo

    public function versao(){
    	return "0.0.3";
    }
}
