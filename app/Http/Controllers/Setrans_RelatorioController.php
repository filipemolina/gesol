<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Setrans_funcionarios_relatorio;
use App\Models\Setrans_relatorio;
use App\Models\Sequencia;
use App\Models\Funcionario;
use App\Models\Atribuicao;
use App\Models\Endereco;
use App\Models\User;
use App\Models\Imagem;
use App\Models\Role;
use PDF;
use DataTables;

class Setrans_RelatorioController extends Controller
{
    public function index(){
       
    //Auth User 
        $logado = Auth::user();
    
    //Teste de Roles
        $setrans = Auth::user()->hasRole('SETRANS_REL');
        $setransgerente = Auth::user()->hasRole('SETRANS_REL_GERENTE');
        $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
        $guardagerente = Auth::user()->hasRole('SEMSOP_REL_GCMM');
    
   //

        return view ('setrans.relatorios',compact('logado','guardagcmm','guardagerente','setrans','setransgerente'));
    }

    public function create(){

    //Auth User 
        $logado = Auth::user();
    
    //Teste de Roles
        $setrans = Auth::user()->hasRole('SETRANS_REL');
        $setransgerente = Auth::user()->hasRole('SETRANS_REL_GERENTE');
        $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
        $guardagerente = Auth::user()->hasRole('SEMSOP_REL_GCMM');

    //Testa se o funcionario tem a role GCMM
    $role = Role::where('nome','=','SETRANS_REL')->with('funcionarios')->get();
       
    $teste = $role[0]->funcionarios;
    //dd($teste);
    $funcionarios = [];
    $a = [];

    foreach ($teste as $funcionario) {
        $a = ['id'=>$funcionario->id,'nome'=>$funcionario->nome];
        array_push($funcionarios,$a);  
    }
    
        return view ('setrans.create',compact('logado','guardagcmm','guardagerente','setrans','setransgerente','funcionarios'));

    }
    
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'cones',
            'bombonas',
            'radios',
            'placas',
            'lanternas',
            'outros',
            'data',
            'hora',
            'registro_ocorrencia'
        ]);
        
        $Setrans_relatorio = new Setrans_relatorio($request->all());
        
        $Setrans_relatorio->numero = 'xxx';

        $Setrans_relatorio->save();
        
        $funcionario_logado = Auth::user();
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
            
            $Setrans_relatorio->imagens()->sync($imagens_ids);

        }

        // Salva o Funcionario logado como relator
        DB::table('setrans_funcionarios_relatorios')->insert(
            ['funcionario_id' => $funcionario_logado->id ,'relator' => true,'setrans_relatorio_id' => $Setrans_relatorio->id]
        );

        //Pega os outros funcionarios atribuidos no relatorio
        $funcios_id = $request->funcionario_id;

        //Tira o primeiro campo que vem nulo
        $filtrado = ( array_filter( $funcios_id , function( $value, $key ) {
            return $value != null; // retorna todos os valores que forem diferentes de null
        }, ARRAY_FILTER_USE_BOTH ) );

        //Itera pelos funcionarios e salva como não relatorl
        foreach($filtrado as $key => $funcionarios){
            DB::table('setrans_funcionarios_relatorios')->insert(
                ['funcionario_id' => $funcionarios,'relator' => false,'setrans_relatorio_id' => $Setrans_relatorio->id]
            );
        } 
        

        return redirect(url('/setrans'));
    }

    public function edit($id)
    {
           //Auth User 
           $logado = Auth::user();
    
           //Teste de Roles
            $setrans = Auth::user()->hasRole('SETRANS_REL');
            $setransgerente = Auth::user()->hasRole('SETRANS_REL_GERENTE');
            $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
            $guardagerente = Auth::user()->hasRole('SEMSOP_REL_GCMM');

        return view('setrans.edit', compact('logado','setrans','setransgerente','guardagcmm','guardagerente'));
    }


    public function show(Request $request, $id)
    {
        //Auth User 
        $logado = Auth::user();
    
        //Teste de Roles
         $setrans = Auth::user()->hasRole('SETRANS_REL');
         $setransgerente = Auth::user()->hasRole('SETRANS_REL_GERENTE');
         $guardagcmm = Auth::user()->hasRole('SEMSOP_REL_GERENTE');
         $guardagerente = Auth::user()->hasRole('SEMSOP_REL_GCMM');

          //Busca o relatorio pelo id
        $relatorio = Setrans_relatorio::with('funcionarios')->find($id);
        //dd($relatorio);
        $imagens = $relatorio->imagens;

         return view('setrans.show',compact('logado','setrans','setransgerente','guardagcmm','guardagerente','relatorio','imagens'));
    }

    public function destroy($id)
    {
        //Pega o relatorio
        $relatorio = Setrans_relatorio::find($id);
        
        //apaga o relatorio
        $apagou = $relatorio->delete();

    
        return redirect(url('/setrans'));
    

    }

    public function imprimir($id)
    {

        $relatorio = Setrans_relatorio::find($id);
        $imagens = $relatorio->imagens;

        //dd($relatorio->origem);
        $pdf = PDF::loadView('setrans/pdf',compact('relatorio','imagens'));
        
        return $pdf->stream('Relatorio.pdf');

      
    }


    public function envia(Request $request)
    {
        $sequencia = Sequencia::first();
        $numero_setrans = $sequencia->numero_setrans;

        $relatorio = Setrans_relatorio::find($request->id);
        $relatorio->enviado = 1;
        $relatorio->numero =  "SETRANS".".".date("Y").".".$numero_setrans;
        
        $relatorio->save();

        $numero_setrans++;

        $sequencia->fill(['numero_setrans' => $numero_setrans]);

        $sequencia->save();


    }

    public function dados()
    {    
        if(Auth::user()->hasRole('SETRANS_REL_GERENTE'))
        {
            // Obtem Todos os Relatorios já enviados
            $arr = Setrans_relatorio::where('enviado',1)->get();
            
        } else {
            // Pegar Somente o Relatorio do funcionario Logado
            $id = Auth::user()->id;
    
            $funcionario_id = Setrans_funcionarios_relatorio::where('funcionario_id', $id)->get();

            $relatorio_funcionario = Setrans_relatorio::find($funcionario_id[0]->setrans_relatorio_id);

            $arr = [];

            foreach($funcionario_id as $relatorios){
                $relatorio_funcionario = Setrans_relatorio::with('funcionarios')->find($relatorios->setrans_relatorio_id);
                array_push($arr,$relatorio_funcionario);
            }
        }

        // Monta a coleção para o DataTables
        $colecao = collect();

        foreach($arr as $relatorio)
        {
            //Montar a coluna de ações da tabela
            $acoes = "";

            if(Auth::user()->hasRole('SETRANS_REL_GERENTE'))
            {
                $acoes .= "<td style='width: 16%;'>
                <a href='".url("/setrans/$relatorio->id")."'
                    class='btn btn-primary btn-xs  action  pull-right botao_acao' 
                    data-toggle='tooltip'
                    data-placement='bottom' 
                    title='Visualiza o Relatorio detalhado'> 
                    <i class='glyphicon glyphicon-eye-open'></i>
                </a> 
                
                <a href=".action('Setrans_RelatorioController@imprimir', $relatorio->id)." 
                        class='btn btn-info btn-xs action pull-right botao_acao'
                        data-toggle='tooltip'  
                        data-placement='bottom'
                        title='Imprimir Relatorio xD'> 
                        <i class='glyphicon glyphicon-print'></i>
                    </a>
            </td>";

            } else if(Auth::user()->hasRole('SETRANS_REL')) {
                
                $acoes .= "<td style='width: 16%;'>
                    <a href='".url("/setrans/$relatorio->id")."'
                        class='btn btn-primary btn-xs  action  pull-right botao_acao' 
                        data-toggle='tooltip'
                        data-placement='bottom' 
                        title='Visualiza o Relatorio detalhado xD'> 
                        <i class='glyphicon glyphicon-eye-open'></i>
                    </a> 
                    
                    <a href=".action('Setrans_RelatorioController@imprimir', $relatorio->id)." 
                        class='btn btn-info btn-xs action pull-right botao_acao'
                        data-toggle='tooltip'  
                        data-placement='bottom'
                        title='Imprimir Relatorio xd'> 
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
                        $acoes .= "<a href=".url("setrans/$relatorio->id/edit")."
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
                'data' => $relatorio->data,
                'numero' => $relatorio->numero,
                'registro_ocorrencia' => mb_strimwidth($relatorio->registro_ocorrencia, 0, 50,"..."),
                'agente' => $relatorio->funcionarios()->where("relator", true)->first()->nome,
                'acoes' => $acoes
            ]);
        }

        return DataTables::of($colecao)
            ->rawColumns(['acoes'])    
            ->make(true);
    }
}
