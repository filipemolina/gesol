@extends('layouts.material')

@section('titulo')

	Relatorios {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<img src="../img/BrasaoTop.png"/>
			<div>
				<center><h3>Relatório</h3></center>
			</div>
			<table class="informacoes_relatorio">
				
				<tr>
					<td> {{ $relatorio->notificacao }} </td>
				</tr>
				<tr>
					<td> {{ $relatorio->autuacao }} </td>
				</tr>
				<tr>
					<td> {{ $relatorio->multa }} </td>
				</tr>	
				<tr>
					<td> {{ $relatorio->registro_dp }} </td>
				</tr>	
				<tr>
					<td> {{ $relatorio->auto_pf }} </td>
				</tr>				
		

				<tr>
					<td>	Origem do serviço: </td> <td> {{ $relatorio->origem }} </td>
				</tr>
				<tr>
					<td>	Data: </td> <td> {{ $relatorio->data }} </td>
				</tr>
				<tr>
					<td>	Hora: </td> <td> {{ $relatorio->hora }} </td>
				</tr>
				<tr>
					<td>	Local: </td> <td> {{ $relatorio->endereco->logradouro }}, {{ $relatorio->endereco->numero }}, {{$relatorio->endereco->bairro}}, {{ $relatorio->endereco->complemento}}
				    </td>
				</tr>
				<tr>
					<td>	Cep: </td> <td> {{ $relatorio->endereco->cep }} </td>
				</tr>
				<tr>
						
					<td> Ação Desenvolvida: </td> <td> {{ $relatorio->acao_cop }}</td>	
					
					<td> Ação Desenvolvida: </td> <td> {{ $relatorio->acao_gcmm }}</td>
					
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
					<td> 	Nome: </td> <td> {{ $relatorio->funcionarios()->where("relator", true)->first()->nome }} </td> 
				</tr>
				<tr>
					<td> Matrícula: </td> <td> {{ $relatorio->funcionarios()->where("relator", true)->first()->matricula }}</td>
				</tr>


							
			</table>
		</div> {{-- Fim card --}}
	</div> {{-- Fim col-md-10 --}}
</div> {{-- FIM ROW --}}

@endsection

@push('scripts')

<script type="text/javascript">
	

</script>

@endpush