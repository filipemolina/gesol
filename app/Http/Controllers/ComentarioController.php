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
use App\Models\Funcionario;
use App\Models\Comentario;
use App\Models\Movimento;
use App\Models\Parametro;
use App\Models\Endereco;
use App\Models\Setor;
use App\Models\User;
use DataTables;


class ComentarioController extends Controller
{
    public function __construct(Comentario $Comentario)
    { 
        $this->middleware('auth');
    }
    

    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        // Variável que indica se uma notificação foi enviada para o dispositivo
        $enviou = false;
        
        // Validar

        $this->validate($request, [
            'comentario'     => 'required|min:2',
            'solicitacao_id' => 'required'
        ]);

        $comentario = new Comentario($request->all());
	    $solicitacao = Solicitacao::find($request->solicitacao_id);

        // Associar com uma solicitação e um funcionário

        $comentario->solicitacao_id = $request->solicitacao_id;
        $comentario->funcionario_id = Auth::user()->funcionario->id;

        //Salvar

        $comentario->save();

        // Testar se esse solicitatante tem um Id do FCM cadastrado. Caso tenha, enviar uma notificação para o seu
        // dispositivo

        $token = $solicitacao->solicitante->fcm_id;

        if($token)
        {
            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder('Sua solicitação foi respondida');
            $notificationBuilder->setBody('Sua solicitação foi respondida')->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['tipo' => 'atualizar', 'model'=>'comentario']);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();

            $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

            $enviou = true;
        }

	    // Fim do envio da notificação

        $resposta                   = new \stdClass();
        $resposta->data_criacao     = \Carbon\Carbon::parse( $comentario->created_at)->format('d/m/Y - H:i:s');
        $resposta->nome_funcionario = $comentario->funcionario->nome;
        $resposta->nome_setor       = $comentario->solicitacao->servico->setor->nome;
        $resposta->sigla            = $comentario->solicitacao->servico->setor->secretaria->sigla;
        $resposta->comentario       = $comentario->comentario;
        $resposta->enviou           = $enviou;

        // Salvar na trilha de auditoria        
        trilha($request->solicitacao_id,        null , null ,"Respondeu" ,null, $comentario->id);

        return json_encode($resposta);

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        $comentario = Comentario::find($id);

        $contador = Comentario::where([
            ['solicitacao_id', $comentario->solicitacao_id],
            ['created_at', '>', $comentario->created_at],
        ])->whereNotNull('funcionario_id')->count();

        if($contador > 0){
            return "0";
        }
        else{
            // $comentario->delete();
            return "1";
        }
    }
}
