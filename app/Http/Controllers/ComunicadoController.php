<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Solicitante;
use App\Models\Funcionario;
use App\Models\Comunicado;
use DataTables;

class ComunicadoController extends Controller
{
    /**
     * Liberado apenas para usuários autenticados
     *
     * @return
     */

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
        // Usuário logado
        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

        return view("comunicados.comunicados", compact('funcionario_logado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Usuário Logado
        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

        return view("comunicados.create", compact('funcionario_logado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'imagem'         => 'required',
            'titulo'         => 'required',
            'subtitulo'      => 'required',
            'texto'          => 'required',
            'funcionario_id' => 'required'
        ], [
            'imagem'    => "O campo 'Imagem' é obrigatório!",
            'titulo'    => "Informe um título para o comunicado!",
            'subtitulo' => "Informe um subtítulo para o comunicado!",
            'texto'     => 'Informe qual o conteúdo da comunicado!'
        ]);

        // Cadastrar o novo Comunicado

        $comunicado = Comunicado::create($request->all());

        // Enviar uma notificação para o dispositivo do usuário que criou a solicitação

        $dados = [
            'operacao'      => 'atualizar',
            'model'         => 'comunicado', 
            'comunicado_id' => $comunicado->id,
            'acao'          => 'atualizar'
        ];

        $tokens = Solicitante::whereNotNull('fcm_id')->get()->pluck('fcm_id')->toArray();

        // Função que envia a notificação para o aparelho do usuário, definida no arquivo helper_geral.php

        $resultados = enviarNotificacao($comunicado->titulo, $comunicado->subtitulo, $tokens, $dados);

        $comunicado->num_dispositivos = $resultados['sucesso'];
        $comunicado->save();

        return redirect('/comunicado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function show(Comunicado $comunicado)
    {
        // Usuário Logado
        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

        dd($comunicado->toArray());

        return view('comunicados.show', compact('funcionario_logado', 'comunicado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function edit(Comunicado $comunicado)
    {
        // Usuário Logado
        $funcionario_logado    = Funcionario::find(Auth::user()->funcionario_id);

        return view('comunicados.edit', compact('funcionario_logado', 'comunicado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comunicado $comunicado)
    {
        // Validar

        $this->validate($request, [
            'imagem'         => 'required',
            'funcionario_id' => 'required',
            'titulo'         => 'required',
            'subtitulo'      => 'required',
            'texto'          => 'required'
        ]);

        $comunicado->fill($request->all());
        $comunicado->save();

        dd($comunicado->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comunicado  $comunicado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comunicado $comunicado)
    {
        $comunicado->delete();
    }

    /**
     * Método que fornece uma coleção com os dados necessários para montar a tabela de comunicados
     */
     
     public function dados()
     {
        // Coleção que será retornada
        $resultado = collect();

        // Obter todos os comunicados
        $comunicados = Comunicado::all();

        // Iterar pelos comunicados e inserí-los na coleção
        foreach($comunicados as $comunicado)
        {
            $resultado->push([
                'imagem'  => "<img src='$comunicado->imagem'></img>",
                'titulo'  => $comunicado->titulo,
                'data'    => \Carbon\Carbon::parse($comunicado->created_at)->format('d/m/Y'),
                'hora'    => \Carbon\Carbon::parse($comunicado->created_at)->format('H:i:s'),
                'alcance' => $comunicado->num_dispositivos." dispositivos",
                'acoes'   => "<a href='".url("/comunicado/$comunicado->id/edit")."' class='btn btn-simple btn-info btn-icon like'><i class='material-icons'>edit</i></a><a href='#' class='btn btn-simple btn-danger btn-icon like btn-excluir' data-id='$comunicado->id'><i class='material-icons'>close</i></a>"
            ]);
        }

        return DataTables::of($resultado)->rawColumns(['imagem', 'acoes'])->make(true);
     }
}
