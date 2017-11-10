<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarSenhaFuncionario;





class EmailController extends Controller
{
 	public function EnviarSenhaFuncionario(Request $request){

 		//envia o email senhafuncionario
		//Mail::to('gesol@mesquita.rj.gov.br')->send(new EnviarSenhaFuncionario());

	/*	Mail::send($request->email,$request, function($message){

			$message->to('marcelo.miranda.pp@gmail.com');
			$message->subject('Titulo da mensagem');

		});*/
		
 	}	
}
 