@extends('layouts.material')

@section('titulo')

	Relatorios {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row" style="max-width: 100%">
	<div class="col-md-12 col-md-offset-0">
		<div class="card" style="padding-left: 6%;">
			<img src="../img/BrasaoTop.png"/>
			<div>
				<h3 style="text-align:center;" >Relatório</h3>
			</div>
			
				
			<div class="row" style="padding-left: 6%;">
				<tr>
					<td>{{ $relatorio->tipo }}</td>
				</tr>
			</div>

			<div class="row" style="text-align:center;display:  flex;justify-content: space-around;">
			
					@if($relatorio->notificacao==1 ) <div>  Notificado </div> @endif
				
					@if($relatorio->autuacao==1 ) <div> Autuado  </div> @endif
				
					@if($relatorio->multa==1 ) <div> Multado  </div> @endif
				
					@if($relatorio->registro_dp==1 ) <div> Registrado na DP  </div> @endif
		
					@if($relatorio->auto_pf==1 ) <div> Auto de Prisão em Flagrante  </div> @endif
								
			</div>

			<div class="row" style="padding-top: 7px;">
				
					<div>	Origem do serviço: {{($relatorio->origem) }}</div>  
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div>	Data: {{ $relatorio->data }} </div>
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div>	Hora: {{ $relatorio->hora }} </div>
			
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div>	Local: {{$relatorio->endereco->bairro}}, {{ $relatorio->endereco->cep }}, {{ $relatorio->endereco->logradouro }}, {{ $relatorio->endereco->numero }} {{ $relatorio->endereco->complemento}}
				    </div>
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div>Envolvidos: {{ $relatorio->envolvidos }} </div>
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div> Ação Desenvolvida: {{ $relatorio->acao_cop }} {{ $relatorio->acao_gcmm }}</div>
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div>	Relato Sucinto: {{ $relatorio->relato }} </div>
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div>	Providencias Adotadas: {{ $relatorio->providencia }} </div>
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
					<div>    Outros Funcionarios:
					@foreach($relatorio->funcionarios()->where("relator", false)->get() as $funcionario)
					 {{ $funcionario->nome }} </div>
					@endforeach
				
			</div>
			<div class="row" style="padding-top: 7px;">
				 	
				<div>Nome: {{ $relatorio->funcionarios()->where("relator", true)->first()->nome }}</div>
			</div>
			<div class="row" style="padding-top: 7px;">
				<div>Matrícula:{{ $relatorio->funcionarios()->where("relator", true)->first()->matricula }}</div>
				
			</div>


							
			
		</div> {{-- Fim card --}}
	</div> {{-- Fim col-md-10 --}}
</div> {{-- FIM ROW --}}

@endsection

