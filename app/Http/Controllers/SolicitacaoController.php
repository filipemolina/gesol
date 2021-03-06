<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Solicitacao;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Comentario;
use App\Models\FCM_Token;
use App\Models\Movimento;
use App\Models\Parametro;
use App\Models\Endereco;
use App\Models\Setor;
use App\Models\User;
use DataTables;

class SolicitacaoController extends Controller
{
	
    private $pusher;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionario_logado   = Funcionario::find(Auth::user()->funcionario_id);

        if( Solicitacao::count() > 0)
        {
            
            switch ($funcionario_logado->role->peso) {
                case 10:
                    //"Moderador"
                    return view('solicitacoes.controle-moderador', compact('funcionario_logado'));
                    break;

                case 20:
                    //"SAC"
                    dd($funcionario_logado->role->acesso);
                    break;

                case 30:
                    //"Funcionario"

                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    break;

                case 40:
                    //"Funcionario_SUP"
                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    break;

                case 50:
                    //"Funcionario_ADM"
                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    break;
                
                case 60:
                    //"Secretario"
                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    break;

                case 70:
                    //"Ouvidor"
                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    break;

                case 80:
                    //"Prefeito"
                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    //dd($funcionario_logado->role->acesso);
                    break;                    

                case 90:
                    //"TI"
                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    break;                    

                case 100:
                    //"DSV"
                    return view('solicitacoes.controle-funcionario', compact('funcionario_logado'));
                    break;
                                        
                default:
                    dd($funcionario_logado->role->acesso);
                    break;
            }


        }else{
            dd("Nenhuma solicitação cadastrada");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //busca o funcionario
        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

        //busca a solicitação que será editada
        /*$solicitacao = Solicitacao::with('endereco','solicitante','servico','servico.setor')->find($id);*/
        $solicitacao = Solicitacao::find($id);

        //verifica se foi dado um prazo diferente para essa solicitação se não, 
        //pega o padrão do serviço
        
        /*if($solicitacao->prazo)
            $prazo_em_dias=$solicitacao->prazo;
        else
            $prazo_em_dias=$solicitacao->servico->prazo;*/

        ////////////////////////////////////////////// Marcar todas as mensagens nessa solicitação como lidas e guardar na trilha de auditoria quem leu

        $solicitacao->comentarios()->update(['lida' => '1']);

        trilha($solicitacao->id, null, null, 'Leu', null, null);

        /////////////////////////////////////////////// Cálculo do prazo
            
        $prazo_em_dias=$solicitacao->prazo;
        
        //cria o prazo com a data setada acima
        $prazo_calculado = date('Ymd', strtotime($solicitacao->created_at." +$prazo_em_dias days"));


        //pega os motivos de RECUSA de solicitação
        $parametros = Parametro::where('parametro', '=', 'motivo-recusa')->get();
        $motivos_recusa = [];
        foreach($parametros as $parametro){$motivos_recusa[$parametro->valor] = $parametro->valor;}

        //pega os motivos de TRANSFER4ENCIA de solicitação
        $parametros = Parametro::where('parametro', '=', 'motivo-transferencia')->get();
        $motivos_transferencia = [];
        foreach($parametros as $parametro){$motivos_transferencia[$parametro->valor] = $parametro->valor;}


        //pega os motivos de alteração de data de PRAZO da  solicitação
        $parametros = Parametro::where('parametro', '=', 'motivo-prazo')->get();
        $motivos_prazo = [];
        foreach($parametros as $parametro){$motivos_prazo[$parametro->valor] = $parametro->valor;}

        // Obter todos os setores
        $setores = Setor::with('servicos')->get();
        
        // chama a view de acordo com o tipo de acesso do usuario logado
        //$funcionario_logado->role->acesso

        
        //testando usar apenas um arquivo de view para todos os utilizadores do sistema
        // return view('solicitacoes.edit-solicitacao', compact('solicitacao','funcionario_logado','setores','motivos_recusa','motivos_transferencia','prazo_calculado','motivos_prazo','prazo_em_dias'));

        
        if($funcionario_logado->role->peso == 10){
            return view('solicitacoes.edit-moderador', compact('solicitacao','funcionario_logado','setores','motivos_recusa','motivos_transferencia','prazo_calculado','motivos_prazo','prazo_em_dias'));

        }else if($funcionario_logado->role->peso >= 30 and $funcionario_logado->role->peso <= 100 ){
            return view('solicitacoes.edit-funcionario', compact('solicitacao','funcionario_logado','setores','motivos_recusa','motivos_transferencia','prazo_calculado','motivos_prazo','prazo_em_dias'));
        }




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * ACAO em request:  
     * 1 = LIBERA a solicitacao
     * 2 = redireciona uma solicitação
     * 3 = edita o CONTEUDO 
     * 4 = recusa solicitação
     * 5 = coloca em execução 
     * 6 = alteração de STATUS      
     * 7 = SOLUCIONA solicitação
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
/*        // Validar
        $this->validate($request, [
            'conteudo' => 'required'
        ]);
*/

        // Salvar as alterações

        // Obter a solicitação
        $solicitacao = Solicitacao::find($id);



        switch($request->acao)
        {
            // edita CONTEUDO
            case 2:
                // Gravar o valor antigo do conteúdo da solicitação para utilizar na trilha de auditoria que o marcelo
                $valor_antigo = $solicitacao->conteudo;

                //salva na trilha
                trilha($solicitacao->id, 'conteudo', $valor_antigo ,"Alterou",null,null);

                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();

                return json_encode("ok");

            //redireciona
            case 3:
                // Gravar o valor antigo do ID do SERVIÇO da solicitação para utilizar na trilha de auditoria
                $valor_antigo = $solicitacao->servico->id;

                //salva na trilha (id do objeto sendo mudado, )
                trilha($solicitacao->id, 'servico_id', $valor_antigo ,"Redirecionou",$request->motivo, null);


                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();

                // Criar um objeto para a resposta
                $solicitacao = Solicitacao::find($id);

                $resposta = new \stdClass();
                $resposta->cor      = $solicitacao->servico->setor->cor;
                $resposta->icone    = $solicitacao->servico->setor->icone;
                $resposta->sigla    = $solicitacao->servico->setor->secretaria->sigla;
                $resposta->servico  = $solicitacao->servico->setor->nome;
                $resposta->setor    = $solicitacao->servico->nome;

                //envia um comentario informando o redirecionamento
                enviarComentarioSolicitacao(
                    'Sua solicitação foi redirecionada pelo seguinte motivo: ' .$request->motivo,
                    $solicitacao
                );
                
                if($alterou){
                    return json_encode(true);
                }
                //return json_encode($request->motivo);

            // recusa solicitação
            case 4:
                //salva na trilha
                trilha($solicitacao->id, 'servico_id', null ,'Recusou', $request->motivo, null);

                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();

                //envia um comentario com o motivo da recusa
                enviarComentarioSolicitacao(
                    'Sua solicitação foi transferida pelo seguinte motivo: ' .$request->motivo,
                    $solicitacao
                );

                if($alterou){
                    return json_encode(true);
                }
                //return json_encode($request->motivo);

            case 5:
                //salva na trilha as informações da mudança STATUS
                //salva na trilha as informações da mudança de prazo
                trilha($solicitacao->id, $request->campo_alterado, $request->valor_antigo ,$request->andamento ,$request->motivo,null);

                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();
                return json_encode($alterou);

            case 6:


                //salva na trilha as informações da mudança de status
                trilha($solicitacao->id, $request->campo_alterado_status, $request->valor_antigo_status ,
                       $request->andamento_status ,$request->motivo_status, null);

                //salva na trilha as informações da mudança de prazo
                trilha($solicitacao->id,$request->campo_alterado_prazo, $request->valor_antigo_prazo ,
                       $request->andamento_prazo ,$request->motivo_prazo, null );

                $solicitacao->fill($request->all());

                $alterou = $solicitacao->save();


                return json_encode("ok");

            // SOLUCIONA solicitação
            case 7:
                //salva na trilha
                trilha($solicitacao->id, 'status', $request->valor_antigo ,'Fechou', 'Solucionou a solicitação',null);

                // Atualizar os dados
                $solicitacao->fill($request->all());
                $alterou = $solicitacao->save();

                return json_encode($request);


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/
    /*================================================================================================================*/


    /**
    * Retorna os dados para montar o datatables
    * @param $liberado int: Determina o tipo de dados ....
    * 0 =  Obter todos os dados de todos os solicitacoes que NÃO estão moderadas / MODERADOR
    * 1 =  Obter todos os dados de todos os solicitacoes que JÁ ESTÃO moderadas
    * 2 =  Obter todos os dados de todos os solicitacoes ATIVAS e MODERADAS
    * 3 =  Obter todos os dados de todos os solicitacoes SOLUCIONADAS e MODERADAS    
    * 4 =  Obter todos os dados de todos os solicitacoes RECUSADAS
    */
    public function dados($liberado)
    {
        // Obter o usuário atualmente logado
        $funcionario_logado = Funcionario::find(Auth::user()->funcionario_id);

        // Os botões de ação da tabela variam de acordo com o 'role' do usuário atual.
        // Aqui  os botões PADRÃO serão criados, de acordo com a role do usuario será
        // atearada no SWITCH abaixo
        $padrao = "  <a href='" .url('solicitacao/{id}/edit')    
                    ."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a>";

        // Vetor que vai guardar uma estrutura da seguinte forma:
        //
        // id_da_solicitacao => numero_de_comentarios_nao_lidos

        $nao_lidas = [];

        //faz a buscas das solicitações de acordo com o filtro selecionado
        switch($liberado)
        {
            case 0:
                // Obter todos os dados de todos os solicitacoes que NÃO estão moderadas / MODERADOR;
                $solicitacoes = Solicitacao::where('moderado','=', '0')
                                ->where('status','<>', 'Recusada')
                                ->with('solicitante','servico','servico.setor','endereco')->get();

                foreach($solicitacoes as $solicitacao){

                    $nao_lidas[$solicitacao->id] = $solicitacao->comentarios()->where('lida', 0)->get()->count();

                }
                // Os botões de ação da tabela variam de acordo com o 'role' do usuário atual.
                $padrao = "  <a href='" .url('solicitacao/{id}/edit')    ."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a>";

                break;

            case 1:
                // Obter todos os dados de todos os solicitacoes que JÁ ESTÃO moderadas;
                $solicitacoes = Solicitacao::where('moderado','=', '1')
                                ->where('status','<>', 'Recusada')
                                ->with('solicitante','servico','servico.setor','endereco')->get();

                foreach($solicitacoes as $solicitacao){

                    $nao_lidas[$solicitacao->id] = $solicitacao->comentarios()->where('lida', 0)->get()->count();

                }
                break;

            case 2:
                // Obter todos os dados de todos os solicitacoes ATIVAS e MODERADAS; 
                $solicitacoes = Solicitacao::where('status','<>','Solucionada')
                                            ->where('status','<>','Recusada')    
                                            ->where('moderado','=', '1')
                                            ->with('solicitante','servico','servico.setor','endereco')->get();

                foreach($solicitacoes as $solicitacao){

                    $nao_lidas[$solicitacao->id] = $solicitacao->comentarios()->where('lida', 0)->get()->count();

                }
                break;

            case 3:
                // Obter todos os dados de todos os solicitacoes FECHADAS, RECUSADAS e MODERADAS;
                $solicitacoes = Solicitacao::where('status','=','Solucionada')
                                            ->where('moderado','=', '1')
                                            ->with('solicitante','servico','servico.setor','endereco')->get();


                foreach($solicitacoes as $solicitacao){

                    $nao_lidas[$solicitacao->id] = $solicitacao->comentarios()->where('lida', 0)->get()->count();

                }

                $padrao = "  <a href='" .url('solicitacao/{id}/edit')    ."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a>";


                break;

            case 4:

                // Obter todos os dados de todos os solicitacoes RECUSADAS;
                $solicitacoes = Solicitacao::where('status','=','Recusada')    
                                            ->with('solicitante','servico','servico.setor','endereco')->get();

                foreach($solicitacoes as $solicitacao){

                    $nao_lidas[$solicitacao->id] = $solicitacao->comentarios()->where('lida', 0)->get()->count();

                }

                $padrao = "  <a href='" .url('solicitacao/{id}/edit')    ."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a>";


                break;


        }

        // Montar a coleção que irá popular a tabela
        $colecao = collect();




        foreach($solicitacoes as $solicitacao)
        {
            //verifica se foi dado um prazo diferente para essa solicitação se não, 
            //pega o padrão do serviço
            if($solicitacao->prazo)
                $prazo_em_dias=$solicitacao->prazo;
            else
                $prazo_em_dias=$solicitacao->servico->prazo;

            //cria o prazo com a data setada acima

            $prazo = date('Ymd', strtotime($solicitacao->created_at." +$prazo_em_dias days"));

            if( date('Ymd') > $prazo )
            {
                $inspan = "<span class='badge' style='background-color:red'>";    
            }elseif( date('Ymd') == $prazo ){
                $inspan = "<span class='badge' style='background-color:orange'>";    
            }else{
                $inspan = "<span class='badge' style='background-color:green'>";    
            };

            // Preparar a string de ações
            $acoes = str_replace(['{id}'], [$solicitacao->id], $padrao);
            /*if(Auth::user()->admin == "Padrão")
                $acoes = str_replace(['{id}', '{nome}'], [$participante->id, str_replace("'", "'", $participante->nome)], $padrao);
            else
                $acoes = str_replace(['{id}', '{nome}'], [$participante->id, str_replace("'", "'", $participante->nome)], $supervisor_master);*/

            if($solicitacao->moderado)
                $moderado = "Sim";
            else
                $moderado = "Não";

            // Caso haja comentários não lidos nesta solicitação, colocar um badge ao lado da imagem indicando a 
            // quantidade

            if($nao_lidas[$solicitacao->id])
                $foto = "<img src='$solicitacao->foto' style='height:60px; width:60px'><span class='badge nao_lidas' style='background-color: #3d276b'>".$nao_lidas[$solicitacao->id]."</span>";
            else
                $foto = "<img src='$solicitacao->foto' style='height:60px; width:60px'>";

            // Caso o usuário seja moderador, adicionar todas as solicitações à coleção sem fazer nenhum teste adicional

            //if($usuario->funcionario->role->acesso == "Moderador")
            
            if(verificaAcesso($funcionario_logado) == "PREFEITURA")
            {
                $colecao->push([
                    'foto'          => $foto,
                    'conteudo'      => $solicitacao->conteudo, 
                    'solicitante'   => $solicitacao->solicitante->nome, 
                    'servico'       => $solicitacao->servico->nome,
                    'status'        => $solicitacao->status,
                    'moderado'      => $moderado,
                    'atualizacao'    => \Carbon\Carbon::parse( $solicitacao->updated_at)->format('d/m/Y - H:i:s'),
                    'abertura'      => "<span style='display:none'>" .\Carbon\Carbon::parse( $solicitacao->created_at)->format('Ymd') ."</span>". \Carbon\Carbon::parse( $solicitacao->created_at)->format('d/m/Y - H:i:s'),
                    'atualizacao'   => \Carbon\Carbon::parse( $solicitacao->updated_at)->format('d/m/Y - H:i:s'),
                    'acoes'         => $acoes,
                    'prazo'         => "<span style='display:none; color:red'>"
                                        .\Carbon\Carbon::parse( $prazo)->format('Ymd') 
                                        ."</span>"
                                        .$inspan 
                                        . \Carbon\Carbon::parse( $prazo)->format('d/m/Y')
                                        ."</span>",
                ]);

            } elseif($solicitacao->servico->setor->secretaria->id == $funcionario_logado->setor->secretaria->id){ 

                // Caso contrário, adicionar à coleção apenas as solicitações que sejam da mesma secretaria que ele

                $colecao->push([
                    'foto'           => $foto,
                    'conteudo'       => $solicitacao->conteudo, 
                    'solicitante'   => $solicitacao->solicitante->nome, 
                    'servico'        => $solicitacao->servico->nome,
                    'status'         => $solicitacao->status,
                    'moderado'       => $moderado,
                    //'abertura'       => \Carbon\Carbon::parse( $solicitacao->created_at)->format('d/m/Y - H:i:s'),
                    'abertura'      => "<span style='display:none'>" 
                                        .\Carbon\Carbon::parse( $solicitacao->created_at)->format('Ymd') 
                                        ."</span>"
                                        .\Carbon\Carbon::parse( $solicitacao->created_at)->format('d/m/Y - H:i:s'),

                    'atualizacao'    => \Carbon\Carbon::parse( $solicitacao->updated_at)->format('d/m/Y - H:i:s'),
                    'acoes'          => $acoes,

                    'prazo'          => "<span style='display:none; color:red'>"
                                        .\Carbon\Carbon::parse( $prazo)->format('Ymd') 
                                        ."</span>"
                                        .$inspan 
                                        . \Carbon\Carbon::parse( $prazo)->format('d/m/Y')
                                        ."</span>",
                                                       
                 ]);
            }
        }

        return DataTables::of($colecao)
        ->rawColumns(['foto','acoes', 'conteudo','abertura','prazo','atualizacao'])
        ->make(true);
    }

    /*
    =======================================================================================================
    ===============================                  AJAX                    ==============================
    =======================================================================================================
    */



    /**
    * Executa as ações do moderador
    * param    $id     int: ID da solicitação
    *          $acao   int: ação que será executada
    * 1 =  Libera a solicitação
    * 2 =
    * 3 =
    */
    public function modera(Request $request)
    {
        // Obter o usuário atualmente logado
        $solicitacao = Solicitacao::find($request->solicitacao_id);

        //executa a ação de acordo com o informado na chamada
        switch($request->acao)
        {
            case 1:
                $solicitacao->moderado = 1;
                $solicitacao->save();

                if (trilha($solicitacao->id, null , null ,"Liberou",null,null))
                {
                    // Obter todos os FCM Tokens dos navegadores

                    $tokens = FCM_Token::whereNotNull('token')->where('celular', 0)->get()->pluck('token')->toArray();

                    $dados = [
                        'operacao' => 'atualizar',
                        'acao'     => 'atualizar',
                        'model' => 'solicitacoes'
                    ];

                    enviarDadosParaApp($tokens, $dados);

                    return redirect('/solicitacao');
                }

                break;

        }
    }



    /**
    * Executa as ações de MUDANÇA de STATUS
    * param    $id     int: ID da solicitação
    *          $acao   int: ação que será executada
    * 1 =  muda STATUS para
    * 2 =
    * 3 =
    */
    public function status(Request $request)
    {
        // Obter o usuário atualmente logado
        $solicitacao = Solicitacao::find($request->solicitacao_id);

        $solicitacao->status = $request->status;
        $solicitacao->save();

        //trilha($solicitacao->id, null , null ,$request->status,null,null);

        return ("OK");
    }

    /**
     * Retorna o número de solicitações com mensagens não lidas e um texto para cada uma delas
     * para que seja colocado na lista de notificações dos funcionários 
     */

    public function naoLidas($setor_id){

        // Obter as solicitações de um setor que possuam comentários não lidos

        $nao_lidas = Solicitacao::whereHas('comentarios', function($query){

            $query->where('lida', 0);

        })->whereHas('servico.setor', function($q2) use ($setor_id){

            $q2->where('id', $setor_id);

        })->where('status', '<>', 'Solucionada')->where('status', '<>', 'Recusada')->get();

        $qtd = $nao_lidas->count();

        $links = [];

        foreach($nao_lidas as $nao_lida){

            $links[] = "<li><a href='https://gesol.mesquita.rj.gov.br/solicitacao/$nao_lida->id/edit'><i class='material-icons' style='margin-right: 5px'>message</i>Mensagens não lidas na Solicitação $nao_lida->id</a><li>";

        }

        return json_encode([
            'qtd' => $qtd,
            'links' => $links
        ]);

    }


    // /**
    // * Executa inserts de trilha em movimentos
    // * param:    
    // *       $solicitacao:   int:    ID da solicitação    
    // *       $campo:         string: campo que sofreu alteração 
    // *       $valor:         string: valor do campo antes da alteração          
    // *       $andamento:     string: tipo de andamento que sofreu a solicitação      
    // *       $motivo:        string: Motivo pelo qual o campo foi alterado
    // *
    // */
    // public function trilha(Request $request)
    // {
 
    //     $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

    //     $movimento = new Movimento([
    //       'funcionario_id'  => $funcionario->id,
    //       'solicitacao_id'  => $solicitacao,
    //       'campo_alterado'  => $campo,
    //       'valor_antigo'    => $valor,
    //       'andamento'       => $andamento,
    //       'motivo'          => $motivo,
    //     ]);
      
    //     return $movimento->save();
    // }
}
