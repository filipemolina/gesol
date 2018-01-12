<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Secretaria;
use App\Models\Servico;
use App\Models\Icone;
use App\Models\Setor;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use DataTables;


class ServicoController extends Controller
{
    public function __construct()
   {
      $this->middleware('auth');

      $this->middleware('is_Adm_Sistema')->only([
         'index',
         'edit',
         'update',
         'destroy',
         'create',
         'store',
      ]);
   }


    
    public function index()
    {
        $usuario            = User::find(Auth::user()->id);
        $funcionario_logado = $usuario->funcionario;
        $secretarias        = Secretaria::all();
        $setores            = Setor::all();
        $servicos           = Servico::all();

        return view ('servicos.index', compact('secretarias','setores','servicos','funcionario_logado'));
    }

    
   public function create()
   {
      $funcionario_logado     = Funcionario::find(Auth::user()->funcionario_id);
      $secretarias            = Secretaria::whereHas('setores')->get();

      $setores                = Setor::all();

      //dd($secretarias);

      return view('servicos.create_edit', compact('funcionario_logado','secretarias','setores'));
   }

    
   public function store(Request $request)
   {
      //o serviço é criado sempre como desabilitado operante = 0
      $request->merge(['operante' => 0 ]);

      //dd($request->all());

      $this->validate($request, [
         'nome'        => 'required|max:50',
         'setor_id'    => 'required',
         'prazo'       => 'required',
      ]);

      // Criar um nova servico
      $servico = new Servico($request->all());

      // Salvar no banco para obter o ID
      $servico->save();

      //salva na trilha
      loga('C', 'SERVICOS',  $servico->id,   null, null, 'Criou o servico ID: '.$servico->id);

      return redirect(url('/servico'))->with('sucesso', 'Servico criado com sucesso.');    

   }

    
   public function show($id)
   {

   }

    
   public function edit($id)
   {

      $funcionario_logado     = Funcionario::find(Auth::user()->funcionario_id);
      $servico                = Servico::find($id);

      //dd($servico->setor());

      $secretarias            = Secretaria::whereHas('setores')->get();
      $setores                = Setor::all();
      

      return view('servicos.create_edit', compact('funcionario_logado','secretarias','setores','servico'));
   }

    
   public function update(Request $request, $id)
   {

      //dd($request->all());
      
      $this->validate($request, [
         'nome'        => 'required|max:50',
         'setor_id'    => 'required',
         'prazo'       => 'required',
      ]);

      $servico            = Servico::find($id);

      $original_servico   = $servico->toArray();
      
      $novo             = $request->toArray();
      $input            = $request->all(); 


      $servico->fill($input);
      $salvou_servico = $servico->save();

      

      //salva as alterações na trilha de auditoria (sys_logs)
      if($original_servico['nome'] != $novo['nome']){
         loga('U', 'SERVICOS', $servico->id, 'nome', $original_servico['nome'], null);
      }

      if($original_servico['setor_id'] != $novo['setor_id']){
         loga('U', 'SERVICOS', $servico->id, 'setor_id', $original_servico['setor_id'], null);
      }

      if($original_servico['prazo'] != $novo['prazo']){
         loga('U', 'SERVICOS', $servico->id, 'prazo', $original_servico['prazo'], null);
      }


      if($salvou_servico)
      { 
         return redirect(url('/servico'))->with('sucesso', 'Informações do Servico alteradas com sucesso.');    
      }else{
         return redirect(url('/servico'));    
      }    

   }

    
    public function destroy($id)
    {
        //
    }


   public function setoresDaSecretaria(Request $request)
   {
      $secretaria = Secretaria::with(['setores'])->where('id', $request->secretaria)->first();   
      return json_encode($secretaria->setores);
   }


   public function MudaStatus_Servico(Request $request)
   {
      // busca a servico
      $servico = Servico::find($request->id);        

      //return json_encode($request->operante);     

      $status_antigo = $servico->operante;    

      $servico->operante = $request->operante;

      //salva a servico
      $servico->save();

      //salva na trilha
      loga('U', 'SERVICOS', $servico->id, 'OPERANTE', $status_antigo, null);

      return json_encode($status_antigo);     
   }


}
