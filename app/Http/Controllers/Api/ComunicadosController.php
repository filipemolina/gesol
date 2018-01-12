<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunicado;

class ComunicadosController extends Controller
{
    /**
     * Retorna uma lista de comunicados para o aplicativo
     */

    public function index()
    {
    	return Comunicado::orderBy('created_at', 'desc')->get()i->take(10)->toJson();
    }
}
