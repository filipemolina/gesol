<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Semsop_relatorio;
use App\Models\Funcionario;
use App\Models\Atribuicao;
use App\Models\Endereco;
use App\Models\User;

class Semsop_RelatorioController extends Controller
{

    private $Semsop_relatorio;

    public function __construct()
    { 
        $this->middleware('auth');
    }
    

    public function index()
    {/*
        if(verificaAtribuicoes($funcionario_logado, ["SEMSOP_REL_FISCAL"])){

        }elseif(verificaAtribuicoes($funcionario_logado, ["SEMSOP_REL_GCMM"])){

        }else*/

        if(verificaAtribuicoes(Auth::user()->funcionario, ["SEMSOP_REL_GERENTE"])){
            $relatorios = Semsop_relatorio::all();
        }else{

            $relatorios = Auth::user()->funcionario->relatorios_semsop;
        }



        return view ('relatorios.relatorios', compact('relatorios'));
    }

    
    public function create()
    {
        //Retorna os Enums para seus respectivos campos
         $origens = pegaValorEnum('semsop_relatorios','origem');
         $acoes_gcmm = pegaValorEnum('semsop_relatorios','acao_gcmm');
         $acoes_cop = pegaValorEnum('semsop_relatorios','acao_cop');
         $funcionarios = Funcionario::all();


         return view ('relatorios.create', compact('origens','acoes_gcmm','acoes_cop','funcionarios'));
    }

    
    public function store(Request $request)
    {

       
            $this->validate($request, [             
            'envolvidos'            =>'required',
            'origem'                =>'required',
            'acao_gcmm'             =>'required_without:acao_cop',
            'acao_cop'              =>'required_without:acao_gcmm',
            
            'relato'                =>'required',
            'providencia'           =>'required',
            'foto',
            'data'                  =>'required',
            'hora'                  =>'required',

            ]);

            
            if($funcionario_logado->atribuicoes()->where('atribuicao', 'SEMSOP_REL_FISCAL')->count() )  
            {
                $request->merge(['tipo' => 'SEMSOP_REL_FISCAL']);
            }elseif($funcionario_logado->atribuicoes()->where('atribuicao', 'SEMSOP_REL_GCMM')->count() ){
                $request->merge(['tipo' => 'SEMSOP_REL_GCMM']);
            }
            
            dd($request);

        // Criar o relatorio
        $Semsop_relatorio = new Semsop_relatorio($request->all());

        // Relacionar com o funcionario
        $relator_id = Auth::user()->funcionario->id;

        // Relacionar a Atribuição com o Funcionario


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

        // Salvar o relatório
        $Semsop_relatorio->save();
      
        // Relacionar o Relator com o Funcionario
        $Semsop_relatorio->funcionarios()->attach($relator_id, ['relator' => true]);

        // Salvar o cara que nao e relator caso haja
        foreach ($request->funcionario_id as $key => $funcionario) {
            $Semsop_relatorio->funcionarios()->attach($funcionario, ['relator' => false]);
        }

        return redirect(url('/semsop'));

    
    }
    
    public function show(Request $request, $id)
    { 
        // dd($request);

        $relatorio = Semsop_relatorio::find($id);



        return view ('relatorios.show', compact('relatorio'));
    }

    
    public function edit($id)
    {
         $origens = pegaValorEnum('semsop_relatorios','origem');
         $acoes_gcmm = pegaValorEnum('semsop_relatorios','acao_gcmm');
         $acoes_cop = pegaValorEnum('semsop_relatorios','acao_cop');
         $funcionarios = Funcionario::all();
    
    
       $relatorio = Semsop_relatorio::findOrFail($id);

        return view('relatorios.edit',compact('relatorio','origens','acoes_gcmm','acoes_cop','funcionarios'));
    }

    
    public function update(Request $request)
    {


    }
    public function destroy($id)
    {
      
       
    }
  }


    
    