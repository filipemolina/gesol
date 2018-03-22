@extends('layouts.material')

@section('titulo')

	Relatorios {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row" style="max-width: 100%">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<img src="../img/BrasaoTop.png"/>
			<div>
				<h3 style="text-align:center;" >Relatório</h3>
			</div>
			<table class="informacoes_relatorio">
				<tr>
					<td>{{ $relatorio->tipo }}</td>
				</tr>
				<tr>
					<td> @if($relatorio->notificacao==1 ) Notificado @endif </td>
				</tr>
				<tr>
					<td> @if($relatorio->autuacao==1 ) Autuado @endif </td>
				</tr>
				<tr>
					<td> @if($relatorio->multa==1 ) Multado @endif </td>
				</tr>	
				<tr>
					<td> @if($relatorio->registro_dp==1 ) Registrado na DP @endif </td>
				</tr>	
				<tr>
					<td> @if($relatorio->auto_pf==1 ) Auto de Prisão em Flagrante @endif </td>
				</tr>				
		

				<tr>
					<td>	Origem do serviço: </td> <td> {{($relatorio->origem) }} </td>
				</tr>
				<tr>
					<td>	Data: </td> <td> {{ $relatorio->data }} </td>
				</tr>
				<tr>
					<td>	Hora: </td> <td> {{ $relatorio->hora }} </td>
				</tr>
				<tr>
					<td>	Local: </td> <td> {{$relatorio->endereco->bairro}}, {{ $relatorio->endereco->cep }}, {{ $relatorio->endereco->logradouro }}, {{ $relatorio->endereco->numero }} {{ $relatorio->endereco->complemento}}
				    </td>
				</tr>
				<tr>
					<td>Envolvidos:</td> <td> {{ $relatorio->envolvidos }} </td>
				</tr>
				<tr>
					<td> Ação Desenvolvida: </td> <td> {{ $relatorio->acao_cop }} {{ $relatorio->acao_gcmm }}</td>
				</tr>
				<tr>
					<td>	Relato Sucinto: </td> <td> {{ $relatorio->relato }} </td>
				</tr>
				<tr>
					<td>	Providencias Adotadas: </td> <td> {{ $relatorio->providencia }} </td>
				</tr>
				<tr>
					<td>    Outros Funcionarios: </td> 
					@foreach($relatorio->funcionarios()->where("relator", false)->get() as $funcionario)
					<td> {{ $funcionario->nome }} </td>
					@endforeach
				</tr>
				<tr> 	
				<td><span style="font-weight:bold;">Nome:</span></td> <td> {{ $relatorio->funcionarios()->where("relator", true)->first()->nome }} </td> 
				<td><span style="font-weight:bold;">Matrícula:</span></td> <td> {{ $relatorio->funcionarios()->where("relator", true)->first()->matricula }}</td>
				</tr>


							
			</table>
		</div> {{-- Fim card --}}
	</div> {{-- Fim col-md-10 --}}
</div> {{-- FIM ROW --}}

@endsection

