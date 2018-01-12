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


class SetorController extends Controller
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
      // busca o usuario
      $usuario = User::find(Auth::user()->id);

      // busca o funcionario logado
      $funcionario_logado = $usuario->funcionario;

      // busca as secretarias 
      $secretarias = Secretaria::all();

      // busca os setores
      $setores = Setor::all();

      //dd($setores);
      return view ('setores.index', compact('secretarias','setores','funcionario_logado'));
   }



   public function create()
   {
      $funcionario_logado   = Funcionario::find(Auth::user()->funcionario_id);
      $secretarias          = Secretaria::all();
      $icones               = Icone::all();

      return view('setores.create_edit', compact('funcionario_logado','secretarias','icones'));
   }


   public function store(Request $request)
   {

      //o setor é criado sempre como coulto
      $request->merge(['oculto' => 1 ]);

      //dd($request);
      $this->validate($request, [
         'nome'             => 'required|max:50',
         'secretaria_id'    => 'required',
         'cor'              => 'required',
         'icone'            => 'required',

      ]);

      // Criar um nova setor
      $setor = new Setor($request->all());

      // Salvar no banco para obter o ID
      $setor->save();

      //salva na trilha
      loga('C', 'SETORES',    $setor->id,   null, null, 'Criou o Setor ID: '.$setor->id);

      return redirect(url('/setor'))->with('sucesso', 'Setor criado com sucesso.');    
   }


   public function show($id)
   {
        //
   }


   public function edit($id)
   {
      $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

      $setor                = Setor::find($id);
      $secretarias          = Secretaria::all();
      $icones               = Icone::all();

      return view('setores.create_edit', compact('funcionario_logado','secretarias','icones','setor'));
   }


   public function update(Request $request, $id)
   {

      $this->validate($request, [
         'nome'             => 'required|max:50',
         'secretaria_id'    => 'required',
         'cor'              => 'required',
         'icone'            => 'required',

      ]);

      $setor            = setor::find($id);

      $original_setor   = $setor->toArray();
      
      $novo             = $request->toArray();
      $input            = $request->all(); 


      $setor->fill($input);
      $salvou_setor = $setor->save();

      

      //salva as alterações na trilha de auditoria (sys_logs)
      if($original_setor['nome'] != $novo['nome']){
         loga('U', 'SETORES', $setor->id, 'nome', $original_setor['nome'], null);
      }

      if($original_setor['secretaria_id'] != $novo['secretaria_id']){
         loga('U', 'SETORES', $setor->id, 'secretaria_id', $original_setor['secretaria_id'], null);
      }

      if($original_setor['cor'] != $novo['cor']){
         loga('U', 'SETORES', $setor->id, 'cor', $original_setor['cor'], null);
      }


      if($original_setor['icone'] != $novo['icone']){
         loga('U', 'SETORES', $setor->id, 'icone', $original_setor['icone'], null);
      }


      if($salvou_setor)
      { 
         return redirect(url('/setor'))->with('sucesso', 'Informações do Setor alteradas com sucesso.');    
      }else{
         return redirect(url('/setor'));    
      }    
    }

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


   public function MudaVisualizacao_Setor(Request $request)
   {
      // busca a setor
       $setor = Setor::find($request->id);        

     //return json_encode($usuario);     

       $oculto_antigo = $setor->oculto;    

       $setor->oculto = $request->oculto;

      //salva a setor
       $setor->save();

     //salva na trilha
       loga('U', 'SETORES', $setor->id, 'OCULTO', $oculto_antigo, null);

       return json_encode($oculto_antigo);     
   }

}
