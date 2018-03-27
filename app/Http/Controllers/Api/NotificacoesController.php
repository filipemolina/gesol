<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FCM_Token;

class NotificacoesController extends Controller
{
	/**
	 * Construtor
	 */

	public function __construct()
	{
		$this->middleware('auth:api');
	}

	/**
	 * Enviar uma notificação para todos os navegadores
	 */

	public function enviaNotificacao(Request $request)
	{

		// Validação

		$this->validate($request, [
			'titulo'    => 'required',
			'subtitulo' => 'required',
			'dados'     => 'required',
		]);

		// Obter todos os tokens que sejam de navegadores

		$tokens = FCM_Token::where('celular', 0)->whereNotNull("token")->get()->pluck('token')->toArray();

		// Enviar a mensagem utilizando a função que se encontra no arquivo app/helpers/helper_geral.php

		return enviarNotificacao($request->titulo, $request->subtitulo, $tokens, $request->dados);

	}

	/**
	 * Enviar dados para dispositivos ou navegadores
	 */

	public function enviaDados(Request $request)
	{

		// Validar

		$this->validate($request, [
			'dados'   => 'required'
		]);

		// Enviar os dados ulitizando a função que se encontra no arquivo app/helpers/helpers_geral.php

		enviarDadosParaApp($request->destino, $request->dados);

	}
}
