<?php

namespace App\Http\Controllers\Api;

use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\Solicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SolicitantesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return Solicitante::where('id', $id)->with([
            'endereco',
            'telefones',
            'user'
        ])->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // A regra "sometimes" valida o campo usando as próximas regras declaradas apenas
        // se o campo não estiver vazio

        $this->validate($request, [
            'solicitante.nome'  => 'required',
            'solicitante.email' => 'required|email',
            'solicitante.cpf'   => 'sometimes|cpf'

        ]);

        // Obter o solicitante pelo id

        $solicitante = Solicitante::with(['endereco', 'telefones', 'user'])->where('id', $id)->first();

        // Alterar os dados do solicitante

        $solicitante->fill($request->solicitante);

        $solicitante->save();

        // Alterar o endereço

        if($request->solicitante['endereco']['logradouro'] != null)
        {
         
            $endereco = Endereco::create($request->solicitante['endereco']);

            $solicitante->endereco()->save($endereco);
        }

        //////////////////// Alterar os telefones

        // Remover todos os telefones atuais

        foreach($solicitante->telefones as $telefone)
        {
            $telefone->delete();
        }

        // Criar novos telefones com os dados da $request

        foreach($request->solicitante['telefones'] as $telefone)
        {

            if($telefone['numero'] != null)
            {
                $solicitante->telefones()->save(new Telefone($telefone));
            }

        }

        $resposta = new \stdClass();
        $resposta->token = $solicitante->user->createToken("Token APP");
        $resposta->solicitante = $solicitante;

        //TODO: Testar essa resposta na tela de alteração de dados do aplicativo
        // Após isso, testar o ciclo completo da solicitação

        return json_encode($resposta);
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

    /**
     * Retorna todas as opções de um enum do banco de dados
     * @param $table string
     * @param $column string
     * @return array
     */

    function pegaValorEnum($table, $column) {

        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type ;

        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $enum = array();

        foreach( explode(',', $matches[1]) as $value )
        {
          $v = trim( $value, "'" );
          $enum[] = $v;
        }

        return json_encode($enum);
    }
}
