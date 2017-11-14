<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarSenhaFuncionario;

use App\Models\User;




class EmailController extends Controller
{
 	public function EnviarSenhaFuncionario(Request $request){

 		 //envia email com a senha de acesso
      Mail::send('emails.senhafuncionario',[ 'email' => $user->email, 'senha' => $senha_gerada ], function($message) use ($enviar_email){
         $message->to($enviar_email);
         //$message->to('marcelo.miranda.pp@gmail.com');
         $message->subject('Cadastro de usuário no GESOL');
      });
   }


   public function ZerarSenhaFuncionario(Request $request){

	 	// busca o usuario
      $usuario = User::find($request->id);

      $enviar_email = $usuario->email;

      //$enviar_email = 'filipe.molina@mesquita.rj.gov.br';


      //gera nova senha
      $senha_gerada       	= str_random(6);
      $usuario->password 	= bcrypt($senha_gerada);

      //salva o usuário
      $usuario->save();

      //salva na trilha
      loga('U', 'USERS', $request->id, 'PASSWORD', 'senha', 'Gerou nova senha');

	 	//envia email com a senha de acesso
      Mail::send('emails.zerasenhafuncionario',[ 'email' => $usuario->email, 'senha' => $senha_gerada ], function($message) use ($enviar_email){
         $message->to($enviar_email);
         //$message->to('marcelo.miranda.pp@gmail.com');
         $message->subject('Senha de acesso ao GESOL');
      });

            return json_encode("ok");		
 	}	
}
 