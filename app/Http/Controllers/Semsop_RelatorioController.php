<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Semsop_funcionario_relatorio;
use App\Models\Semsop_relatorio;
use App\Models\Sequencia;
use App\Models\Funcionario;
use App\Models\Atribuicao;
use App\Models\Endereco;
use App\Models\User;
use App\Models\Imagem;
use App\Models\Role;
use PDF;
use DataTables;

class Semsop_RelatorioController extends Controller
{

    private $Semsop_relatorio;

    public function __construct()
    { 
        $this->middleware('auth');
    }
    

    public function index()
    {
        $logado = Auth::user();
        // dd($logado);

        //Roles
        $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GCMM');
		$guardagerente = Auth::user()->hasRole('SEMSOP_REL_GERENTE');

        $id = Auth::user()->id;

        $a = Semsop_funcionario_relatorio::where('funcionario_id', $id)->get();
        //dd($a);
        $b = Semsop_relatorio::find($a[0]->semsop_relatorio_id);
        //dd($b);

        $arr = [];
        foreach($a as $relatorios){
            $b = Semsop_relatorio::with('endereco','funcionarios')->find($relatorios->semsop_relatorio_id);

           array_push($arr,$b);

        }
       //dd($arr[1]->funcionarios[1]->pivot->relator);
        
        return view ('relatorios.relatorios',compact('logado','guardagcmm','guardagerente'));

    }

    
    public function create()
    {
        //Pega o usuario logado
        $logado = Auth::user();
      
        //Roles
        $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GCMM');
        $guardagerente = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
        $fiscal =  Auth::user()->hasRole('SEMSOP_REL_FISCAL');

        //Testa se o funcionario tem a role GCMM
        $role = Role::where('nome','=','SEMSOP_REL_GCMM')->with('funcionarios')->get();
       
        $teste = $role[0]->funcionarios;
        //dd($teste);
        $funcionarios = [];
        $a = [];

        foreach ($teste as $funcionario) {
            $a = ['id'=>$funcionario->id,'nome'=>$funcionario->nome];
            array_push($funcionarios,$a);  
        }

        //Retorna os Enums para seus respectivos campos
        $origens = pegaValorEnum('semsop_relatorios','origem');
        $acoes_gcmm = pegaValorEnum('semsop_relatorios','acao_gcmm');
        $acoes_cop = pegaValorEnum('semsop_relatorios','acao_cop');

         return view ('relatorios.create',compact('logado','fiscal','guardagcmm','guardagerente','origens','acoes_gcmm','acoes_cop','funcionarios'));
    }

    
    public function store(Request $request)
    {
            //dd($request->all());
            $this->validate($request, [             
                'envolvidos'            =>'required',
                'origem'                =>'required',
                'acao_gcmm'             =>'required_without:acao_cop',
                'acao_cop'              =>'required_without:acao_gcmm',
                'relato'                =>'required',
                'providencia'           =>'required',
                'data'                  =>'required',
                'hora'                  =>'required',
                ]);
            //dd($funcionario_logado);

            $funcionario_logado = Auth::user();
            // Auth::user()->hasRole('SEMSOP_REL_GCMM');
            if($funcionario_logado->hasRole('SEMSOP_REL_GCMM'))  
            {
                $request->merge(['tipo' => 'GCMM']);
            }elseif($funcionario_logado->hasRole('SEMSOP_REL_FISCAL')){
                $request->merge(['tipo' => 'COP']);
            }
            


        // Criar o relatorio
        $Semsop_relatorio = new Semsop_relatorio($request->all());
        
        // Relacionar com o funcionario
        $relator_id = Auth::user()->id;

        //Verifica se o CheckBox esta marcado 
        $Semsop_relatorio['notificacao']     = ( $Semsop_relatorio['notificacao'] == '') ? null : 1;
        $Semsop_relatorio['autuacao']        = ( $Semsop_relatorio['autuacao'] == '') ? null : 1;
        $Semsop_relatorio['multa']           = ( $Semsop_relatorio['multa'] == '') ? null : 1;
        $Semsop_relatorio['registro_dp']     = ( $Semsop_relatorio['registro_dp'] == '') ? null :1;
        $Semsop_relatorio['auto_pf']         = ( $Semsop_relatorio['auto_pf'] == '') ? null : 1;
        
        // Criar o endereço
        $endereco = Endereco::create($request->all());

        
        // Relacionar o endereço com o relatorio
        $Semsop_relatorio->endereco_id = $endereco->id;
        
        //obtem o próximo valor da sequence de numeração do relatorio e coloca no campo numero
        //$Semsop_relatorio->numero = proximoValorSequence('semsop_relatorios_numero'); 
        //$Semsop_relatorio->numero = obtemNumeroRelatorioSemsop($request->tipo); 
        $Semsop_relatorio->numero = 'xxx';
        //dd($Semsop_relatorio);
        
        //dd($Semsop_relatorio->numero);

        //dd($request->all());
        // Salvar o relatório
        $Semsop_relatorio->save();

        //Salvar as imagens

        // Testar se alguma imagem foi enviada
        if(count($request->imagens) > 1){
            
            //dd($request->imagens);

            // Vetor que vai armazenar todos os ids das imagens
            $imagens_ids = [];
            
            // Iterar por todas as imagens
            foreach($request->imagens as $imagem){
                // O vetor de imagens sempre possui uma posição nula referente ao campo
                // hidden que é usado para clonar
                if($imagem !== null){
                    
                    //dd($imagem);
                    $img = Imagem::create([
                        'imagem' => $imagem,
                    ]);

                    $imagens_ids[] = $img->id;
                }

            }
            
            $Semsop_relatorio->imagens()->sync($imagens_ids);

        }
        
        // Salva o Funcionario logado como relator
        DB::table('semsop_funcionarios_relatorios')->insert(
            ['funcionario_id' => $funcionario_logado->id ,'relator' => true,'semsop_relatorio_id' => $Semsop_relatorio->id]
        );
        
        //Pega os outros funcionarios atribuidos no relatorio
        $funcios_id = $request->funcionario_id;
        
        //Tira o primeiro campo que vem nulo
        $filtrado = ( array_filter( $funcios_id , function( $value, $key ) {
            return $value != null; // retorna todos os valores que forem diferentes de null
        }, ARRAY_FILTER_USE_BOTH ) );
        
        //Itera pelos funcionarios e salva como não relatorl
        foreach($filtrado as $key => $funcionarios){
            DB::table('semsop_funcionarios_relatorios')->insert(
                ['funcionario_id' => $funcionarios,'relator' => false,'semsop_relatorio_id' => $Semsop_relatorio->id]
            );
        }       

        return redirect(url('/semsop'));

    
    }
    
    public function show(Request $request, $id)
    { 
        $logado = Auth::user();
        // dd($request);
        //Roles

        $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GCMM');
        $guardagerente = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
        
        //Busca o relatorio pelo id
        $relatorio = Semsop_relatorio::with('endereco','funcionarios')->find($id);
        //dd($relatorio);
        $imagens = $relatorio->imagens;



        return view ('relatorios.show', compact('relatorio','imagens','logado','guardagcmm','guardagerente'));
    }

    
    public function edit($id)
    {
        $logado = Auth::user();
        //dd($logado);
        
        //Roles
        $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GCMM');
		$guardagerente = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
        $fiscal =  Auth::user()->hasRole('SEMSOP_REL_FISCAL');

        $relatorio = Semsop_relatorio::find($id);
        $origens = pegaValorEnum('semsop_relatorios','origem');
        $acoes_gcmm = pegaValorEnum('semsop_relatorios','acao_gcmm');
        $acoes_cop = pegaValorEnum('semsop_relatorios','acao_cop');

         //Testa se o funcionario tem a role GCMM
         $role = Role::where('nome','=','SEMSOP_REL_GCMM')->with('funcionarios')->get();
       
         $teste = $role[0]->funcionarios;
         //dd($teste);
         $funcionarios = [];
         $a = [];
 
         foreach ($teste as $funcionario) {
             $a = ['id'=>$funcionario->id,'nome'=>$funcionario->nome];
             array_push($funcionarios,$a);  
         }

        
         //dd($funcionarios);

        $imagens = $relatorio->imagens;

    
        return view('relatorios.edit',compact('relatorio','origens','acoes_gcmm','acoes_cop','fiscal','funcionarios','imagens','logado','guardagcmm','guardagerente'));
    }

    
    public function update(Request $request, $id)
    {  
        
        // Pega o relatorio pelo id
        $relatorio = Semsop_relatorio::find($id);
        
        //Entra na tabela pivo e ve quem nao e relator
        $relatorio->funcionarios()->wherePivot('relator', false)->detach();
        //adiciona ou exclui funcionario nao relator
        foreach ($request->funcionario_id as $key => $funcionario) {
            $relatorio->funcionarios()->attach($funcionario, ['relator' => false]);
        }

        $relatorio->endereco->fill($request->all());
        $relatorio->endereco->save();
        
        //Passa os valores das checkBox
        $relatorio->notificacao     = $request->notificacao;
        $relatorio->autuacao        = $request->autuacao;
        $relatorio->multa           = $request->multa;
        $relatorio->registro_dp     = $request->registro_dp;
        $relatorio->auto_pf         = $request->auto_pf;


        $relatorio->fill($request->all());

        $relatorio->save();

         // Testar se alguma imagem foi enviada
        if(count($request->imagens) > 1){

            // Vetor que vai armazenar todos os ids das imagens
            $imagens_ids = [];

            // Iterar por todas as imagens
            foreach($request->imagens as $imagem){

                // O vetor de imagens sempre possui uma posição nula referente ao campo
                // hidden que é usado para clonar
                if($imagem !== null){

                    $img = Imagem::create([
                        'imagem' => $imagem,
                    ]);

                    $imagens_ids[] = $img->id;
                }

            }
            
            $relatorio->imagens()->attach($imagens_ids);

        }


        return redirect(url('/semsop'));

    }
    public function destroy($id)
    {
        //Pega o relatorio
        $relatorio = Semsop_relatorio::find($id);
        //Pega o id do endereco presente no relatorio
        $endereco_id = $relatorio->endereco_id;
        //apaga o relatorio
        $apagou = $relatorio->delete();

        if($apagou)
        {
            //Se o relatorio for apagado, apaga o endereco
            $endereco = Endereco::find($endereco_id);
            $endereco->delete();
             return redirect(url('/semsop'));
        }else{
            return redirect()->route('relatorios.edit', $id)->with(['errors' => 'Falha']);
        }


    }

    public function imprimir($id)
    {

        $relatorio = Semsop_relatorio::find($id);
        $imagens = $relatorio->imagens;

        //dd($relatorio->origem);
        $pdf = PDF::loadView('relatorios/pdf',compact('relatorio','imagens'));
        
        return $pdf->stream('Relatorio.pdf');

      
    }
    
     public function envia(Request $request)
     {
        //Pega o valor da sequencia
        $sequencia = Sequencia::first();
        $numero = $sequencia->numero;

        //Pega o Id do relatorio
        $relatorio = Semsop_relatorio::find($request->id);
        $tipo = $relatorio->tipo;
        $relatorio->enviado = 1;
        $relatorio->numero =  $tipo.".".date("Y").".".$numero;

        $relatorio->save();

        $numero++;

        $sequencia->fill(['numero' => $numero] );

        $sequencia->save();

     }

    ///////////////////////////////////////////////////////////////////////////
    // DATATABLES SERVER SIDE                                                //
    ///////////////////////////////////////////////////////////////////////////

    public function dados()
    {
        
       
        if(Auth::user()->hasRole('SEMSOP_REL_GERENTE'))
        {
            // Obter todos os relatórios já enviados

            $arr = Semsop_relatorio::where('enviado', 1)->get();
            //dd($relatorios);

        } else {

            // Obter apenas os meus próprios relatorios
            $id = Auth::user()->id;

            $a = Semsop_funcionario_relatorio::where('funcionario_id', $id)->get();

            $b = Semsop_relatorio::find($a[0]->semsop_relatorio_id);
            //dd($a);
        
            $arr = [];
        
            foreach($a as $relatorios){
                $b = Semsop_relatorio::with('endereco','funcionarios')->find($relatorios->semsop_relatorio_id);
                array_push($arr,$b);

        }


        }

        // Montar a coleção que irá servir os dados à tabela
        $colecao = collect();

        // Montar a coleção
        foreach($arr as $relatorio)
        {
            //Montar a coluna de ações da tabela
            $acoes = "";

            if(Auth::user()->hasRole('SEMSOP_REL_GERENTE'))
            {
            // 
            $acoes .= "<td style='width: 16%;'>
                    <a href='".url("/semsop/$relatorio->id")."' 
                        class='btn btn-primary btn-xs  action  pull-right botao_acao' 
                        data-toggle='tooltip'
                        data-placement='bottom' 
                        title='Visualiza o Relatorio detalhado'> 
                        <i class='glyphicon glyphicon-eye-open'></i>
                    </a> 
                    
                    <a href=".action('Semsop_RelatorioController@imprimir', $relatorio->id)." 
                        class='btn btn-info btn-xs action pull-right botao_acao'
                        data-toggle='tooltip'  
                        data-placement='bottom'
                        title='Imprimir Relatorio'> 
                        <i class='glyphicon glyphicon-print'></i>
                    </a>
                </td>";

            } else if(Auth::user()->hasRole('SEMSOP_REL_GCMM')) {

            
                $acoes .= "<td style='width: 16%;'>
                    <a href='".url("/semsop/$relatorio->id")."' 
                        class='btn btn-primary btn-xs  action  pull-right botao_acao' 
                        data-toggle='tooltip'
                        data-placement='bottom' 
                        title='Visualiza o Relatorio detalhado'> 
                        <i class='glyphicon glyphicon-eye-open'></i>
                    </a> 
                    
                    <a href=".action('Semsop_RelatorioController@imprimir', $relatorio->id)." 
                        class='btn btn-info btn-xs action pull-right botao_acao'
                        data-toggle='tooltip'  
                        data-placement='bottom'
                        title='Imprimir Relatorio'> 
                        <i class='glyphicon glyphicon-print'></i>
                    </a>
                </td>";
                
                if(!$relatorio->enviado)
                {
                    foreach ($relatorio->funcionarios as $key => $funcionario) {

                        if ($funcionario->pivot->relator){
                            $cabra_relator =  $funcionario->id;
                        }
                    }
                    //if(Auth::user()->id == $relatorio->funcionarios[0]->id){
                    if(Auth::user()->id == $cabra_relator){
                        if($relatorio->funcionarios[0]->pivot->relator){
                        $acoes .= "<a href=".url("semsop/$relatorio->id/edit")."
                            class='btn btn-warning btn-xs action  pull-right botao_acao btn_control' 
                            data-toggle='tooltip' 
                            data-placement='bottom'
                            title='Editar Relatorio'>  
                            <i class='glyphicon glyphicon-pencil'></i>
                        </a>
                        
                        <button
                            class='btn btn-success btn-xs  action  pull-right botao_acao btn_control btn_enviar' 
                            data-toggle='tooltip'
                            data-placement='bottom'
                            title='Enviar Relatorio'
                            data-relatorio ='".$relatorio->id."'> 
                            <i class='glyphicon glyphicon-ok'></i>
                        </button>
                                
                        <a class='btn btn-danger btn-xs action pull-right botao_acao btn_deletar btn_control'
                            data-toggle='tooltip'
                            data-placement='bottom'
                            title='Excluir Relatorio'
                            data-relatorio='".$relatorio->id."'> 
                            <i class='glyphicon glyphicon-trash'></i>
                        </a>";
                        }
                    }
                }
            }

            $colecao->push([
                'origem' => $relatorio->origem,
                'local'  => $relatorio->endereco->logradouro,
                'numero' => $relatorio->numero,
                'relato' => mb_strimwidth($relatorio->relato, 0, 70,"..."),
                'data'   => date('d-m-Y', strtotime($relatorio->data)),
                'agente' => $relatorio->funcionarios()->where("relator", true)->first()->nome,
                'acoes'  => $acoes
            ]);
        }

        // Retornar a coleção como um objeto Datatables
        return DataTables::of($colecao)
                ->rawColumns(['acoes'])
                ->make(true);

    }


  }


    
    