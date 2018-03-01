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
    {
        $relatorios = Semsop_relatorio::all();
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
            'tipo',                    
            'relato'                =>'required',
            'providencia'           =>'required',
            'foto',
            'data'                  =>'required',
            'hora'                  =>'required',

            ]);


        // Criar o relatorio
        $Semsop_relatorio = new Semsop_relatorio($request->all());
        // Relacionar com o funcionario
        $relator_id = Auth::user()->funcionario->id;

        //Verifica se o CheckBox esta marcado 0 = falso e 1 = verdadeiro
        $Semsop_relatorio['notificacao']     = ( $Semsop_relatorio['notificacao'] == '') ? 0 : 1;
        $Semsop_relatorio['autuacao']        = ( $Semsop_relatorio['autuacao'] == '') ? 0 : 1;
        $Semsop_relatorio['multa']           = ( $Semsop_relatorio['multa'] == '') ? 0 : 1;
        $Semsop_relatorio['registro_dp']     = ( $Semsop_relatorio['registro_dp'] == '') ? 0 : 1;
        $Semsop_relatorio['auto_pf']         = ( $Semsop_relatorio['auto_pf'] == '') ? 0 : 1;

        // Criar o endereço
        $endereco = Endereco::create($request->all());

        // Relacionar o endereço com o relatorio
        $Semsop_relatorio->endereco_id = $endereco->id;

        // Salvar o relatório
        $Semsop_relatorio->save();

        $Semsop_relatorio->funcionarios()->attach($relator_id, ['relator' => true]);

        return redirect(url('/semsop'));

    
    }
    
    public function show($id)
    {
        
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
      
    }
  }
