<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Semus_relatorio;
use App\Models\Funcionario;
use App\Models\Atribuicao;
use App\Models\User;
use App\Models\Imagem;
use PDF;

class Semus_RelatorioController extends Controller
{
    private $Semus_relatorio;

    public function __construct()
    { 
        $this->middleware('auth');
    }

    public function index()
    {

        if(verificaAtribuicoes(Auth::user()->funcionario,["SEMUS_REL_GERENTE"])){
            $relatorios = Semus_relatorio::all()->where('enviado', '1');
        }else{
            $relatorios = Auth::user()->funcionario->relatorios_semus;
        }        

       return view ('semus_relatorios.relatorios', compact('relatorios'));

    }

    
    public function create()
    {

        return view ('semus_relatorios.create');

    }

    
    public function store(Request $request)
    {

        // dd($request);
        $this->validate($request, [             
            'relato'              =>'required',
            'data'                =>'required',
            'hora'                =>'required',   
        ]);

        // Criar o relatorio
        $Semus_relatorio = new Semus_relatorio($request->all());
        // Salvar o relatório

        
        $funcionario_id = Auth::user()->funcionario->id;
        
        $Semus_relatorio->funcionario_id = $funcionario_id;

        $Semus_relatorio->save();

        //Salvar a imagens

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
            
            $Semus_relatorio->imagens()->sync($imagens_ids);

        }

        return redirect(url('/semus'));
    
    }

   
    public function show(Request $request, $id)
    {

        $relatorio = Semus_relatorio::find($id);
        $imagens = $relatorio->imagens;




        return view ('semus_relatorios.show', compact('relatorio','imagens'));

    }

    
    public function edit($id)
    {
      
        $relatorio = Semus_relatorio::find($id);
    
        return view('semus_relatorios.edit',compact('relatorio'));

    }

    
    public function update(Request $request, $id)
    {
       //dd($request->all());
        // Pega o relatorio pelo id
        $relatorio = Semus_relatorio::find($id);

        $relatorio->fill($request->all());

        $relatorio->save();

        return redirect(url('/semus')); 
    }

   
    public function destroy($id)
    {
        
        //Pega o relatorio
        $relatorio = Semus_relatorio::find($id);
        //apaga o relatorio
        $relatorio->delete();

        return redirect(url('/semus'));
    }

    public function imprimir($id)
    {

        $relatorio = Semus_relatorio::find($id);
        $imagens = $relatorio->imagens;

        //dd($relatorio->origem);
        $pdf = PDF::loadView('semus_relatorios/pdf',compact('relatorio','imagens'));
        
        return $pdf->stream('Relatorio.pdf');

      
    }

     public function envia(Request $request)
     {
        $relatorio = Semus_relatorio::find($request->id);

        $relatorio->enviado = 1;
        $relatorio->save();


     }
}
