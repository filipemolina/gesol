<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Secretaria;
use App\Models\Funcionario;
use App\Models\Endereco;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use DataTables;



class HomeController extends Controller
{
	public function __construct()
	{
	$this->middleware('auth');
	}

	
	public function index()
	{
		$logado = Auth::user();
		//dd($funcionario_logado);
		$guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GCMM');
		$guardagerente = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
		$setrans = Auth::user()->hasRole('SETRANS_REL');
		$setransgerente = Auth::user()->hasRole('SETRANS_REL_GERENTE');
		//dd("Nenhuma solicitação cadastrada");
		return view('dashboard.dash-Vazia', compact('logado','guardagcmm','guardagerente','setrans','setransgerente'));
		
	}

}
