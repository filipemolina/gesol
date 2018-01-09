<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Movimento;
use App\Models\Parametro;
use App\Models\Endereco;
use App\Models\Icone;
use App\Models\Setor;
use App\Models\User;
use DataTables;

class IconeController extends Controller
{
	/**
 	* Retorna os dados para montar o datatables de icones create_edit de setores
 	*/
	public function dados_datatable()
	{
		
      $icones = Icone::all();
		
     	// Montar a coleção que irá popular a tabela
		$colecao = collect();

		foreach($icones as $icone)
		{
			$acoes = "<button 
						class=\"btn btn_usar_icone btn-warning btn-xs action pull-right botao_acao \" 
						data-toggle=\"tooltip\" 
						data-icone = ".  $icone->classe 
						." data-placement=\"bottom\" 
						title=\"Usar esse Icone\">  
						<i class=\"glyphicon glyphicon-plus \"></i>
					</button>";

         // Preparar a string de ações
			//$acoes = str_replace(['{id}'], [$icone->id], $padrao);

      	$colecao->push([
      		'classe'	=> $icone->nome,
      		'nome'	=> '<i style="font-size: 30px;" class="mdi '.  $icone->classe .'"></i>' , 
      		'acoes'	=> $acoes,
      	]);
      }
   
      return DataTables::of($colecao)
      ->rawColumns(['acoes','nome'])
      ->make(true);
   
   }
}