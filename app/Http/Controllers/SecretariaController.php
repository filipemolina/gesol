<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Secretaria;
use App\Models\Servico;
use App\Models\Setor;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use DataTables;


class SecretariaController extends Controller
{
    
   public function __construct()
   {
      $this->middleware('auth');

      // $this->middleware('is_Gerir_Usuarios')->only([
      //    'index',
      //    'edit',
      //    'update',
      //    'destroy',
      //    'create',
      //    'store',
      // ]);
   }


   public function index()
   {

      // busca o usuario
      $usuario = User::find(Auth::user()->id);

      // busca o funcionario logado
      $funcionario_logado = $usuario->funcionario;

      // busca as secretarias
      $secretarias = Secretaria::all();

      return view ('secretarias.index', compact('secretarias','funcionario_logado'));

   }


    
   public function create()
   {
      $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);
      return view('secretarias.create_edit', compact('funcionario_logado'));
   }

    
   public function store(Request $request)
   {

      //formata o inicio_atendimento no request
      if($request->has('inicio_atendimento')){
         $inicio_atendimento = \Carbon\Carbon::createFromFormat('g:i A',$request->inicio_atendimento)->toTimeString();
         $request->merge(['inicio_atendimento' => $inicio_atendimento ]);
      }

      //formata a hora no request
      if($request->has('termino_atendimento')){
         $termino_atendimento = \Carbon\Carbon::createFromFormat('g:i A',$request->termino_atendimento)->toTimeString();
         $request->merge(['termino_atendimento' => $termino_atendimento ]);
      }

      //coloca a SIGLA em UPPERCASE no request
      if($request->has('sigla')){
         $request->merge(['sigla' => trim(strtoupper($request->sigla)) ]);
      }

      $this->validate($request, [
         'nome'                  => 'required|max:100',
         'sigla'                 => 'required|max:10|unique:secretarias',
      ]);


      //se existir email no request ele deve ser validado
      if($request->has('email')){
         $this->validate($request, [
            'email' => 'email|max:191'
         ]);
      }


      // Criar uma nova secretaria
      $secretaria = new Secretaria($request->all());

      // Salvar no banco para obter o ID
      $secretaria->save();

      //salva na trilha
      loga('C', 'SECRETARIAS',    $secretaria->id,   null, null, 'Criou a Secretaria ID: '.$secretaria->id);

      return redirect(url('/secretaria'))->with('sucesso', 'Secretaria criada com sucesso.');    
   }

    
    public function show($id)
    {
        //
    }

    
   public function edit($id)
   {
      $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

      $secretaria     = Secretaria::find($id);
      $setores        = Setor::all()->sortBy('nome');        
      $servicos       = Servico::all()->sortBy('nome');        

      return view('secretarias.create_edit', compact('funcionario_logado','secretaria','setores','servicos','roles'));
   }


    public function update(Request $request, $id)
    {

      if($request->has('inicio_atendimento')){
         $inicio_atendimento = \Carbon\Carbon::createFromFormat('g:i A',$request->inicio_atendimento)->toTimeString();
         $request->merge(['inicio_atendimento' => $inicio_atendimento ]);
      }

      if($request->has('termino_atendimento')){
         $termino_atendimento = \Carbon\Carbon::createFromFormat('g:i A',$request->termino_atendimento)->toTimeString();
         $request->merge(['termino_atendimento' => $termino_atendimento ]);
      }
     
      //coloca a SIGLA em UPPERCASE no request
      if($request->has('sigla')){
         $request->merge(['sigla' => trim(strtoupper($request->sigla)) ]);
      }

      //dd($request);

      $secretaria    = Secretaria::find($id);

      $this->validate($request, [
         'nome'                  => 'required|max:100',
         'sigla'                 => 'required|max:10|unique:secretarias,id,'.$id
      ]);


      if($request->has('email')){
         $this->validate($request, [
            'email' => 'email|max:191'
         ]);
      }




      $original_secretaria   = $secretaria->toArray();
      
      $novo                   = $request->toArray();
      $input                  = $request->all(); 


      $secretaria->fill($input);
      $salvou_secretaria = $secretaria->save();

      

      //salva as alterações na trilha de auditoria (sys_logs)
      if($original_secretaria['nome'] != $novo['nome']){
         loga('U', 'SECRETARIAS', $secretaria->id, 'nome', $original_secretaria['nome'], null);
      }

      if($original_secretaria['secretario'] != $novo['secretario']){
         loga('U', 'SECRETARIAS', $secretaria->id, 'secretario', $original_secretaria['secretario'], null);
      }

      if($original_secretaria['sigla'] != $novo['sigla']){
         loga('U', 'SECRETARIAS', $secretaria->id, 'sigla', $original_secretaria['sigla'], null);
      }

      if($original_secretaria['email'] != $novo['email']){
         loga('U', 'SECRETARIAS', $secretaria->id, 'email', $original_secretaria['email'], null);
      }


      if($original_secretaria['inicio_atendimento'] != $novo['inicio_atendimento']){
         loga('U', 'SECRETARIAS', $secretaria->id, 'inicio_atendimento', $original_secretaria['inicio_atendimento'], null);
      }

      if($original_secretaria['termino_atendimento'] != $novo['termino_atendimento']){
         loga('U', 'SECRETARIAS', $secretaria->id, 'termino_atendimento', $original_secretaria['termino_atendimento'], null);
      }


      if($salvou_secretaria)
      { 
         return redirect(url('/secretaria'))->with('sucesso', 'Informações da Secretaria alteradas com sucesso.');    
      }else{
         return redirect(url('/secretaria'));    
      }    }

    public function destroy($id)
    {
        //
    }

   public function MudaStatus_Secretaria(Request $request)
   {
   // busca a secretaria
     $secretaria = Secretaria::find($request->id);        
     
     //return json_encode($usuario);     

     $status_antigo = $secretaria->operante;    

     $secretaria->operante = $request->operante;

     
      //salva a secretaria
     $secretaria->save();

     //salva na trilha
     loga('U', 'SECRETARIAS', $secretaria->id, 'OPERANTE', $status_antigo, null);

     return json_encode($status_antigo);     

   }
   
}
