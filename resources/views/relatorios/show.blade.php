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
			
				
			<div class="row" style="padding-left: 80%;">
				<tr>
					{{-- <td>{{ $relatorio->tipo }}</td> --}}
					<td>{{ $relatorio->numero}}</td>
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
				
				<strong>Ação Desenvolvida:</strong> {{ $relatorio->acao_cop }} {{ $relatorio->acao_gcmm }}
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
				<strong>Origem do serviço:</strong> {{($relatorio->origem) }}
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
				<strong>Data:</strong> {{ date('d-m-Y', strtotime($relatorio->data)) }} 
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
				<strong>Hora:</strong> {{ $relatorio->hora }} 

			</div>
			<div class="row" style="padding-top: 7px;">
				
				<strong>Local:</strong> {{$relatorio->endereco->bairro}}, {{ $relatorio->endereco->cep }}, {{ $relatorio->endereco->logradouro }}, {{ $relatorio->endereco->numero }} {{ $relatorio->endereco->complemento}}
				   
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
				<strong>Envolvidos:</strong> {{ $relatorio->envolvidos }}
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
			    <strong>Relato Sucinto:</strong> {{ $relatorio->relato }} 
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
				<strong>Providencias Adotadas:</strong> {{ $relatorio->providencia }} 
				
			</div>
			<div class="row" style="padding-top: 7px;">
				
				 <strong>Outros Funcionarios</strong>
					@foreach($relatorio->funcionarios()->where("relator", false)->get() as $funcionario)
						<div>{{ $funcionario->nome }}</div>
					@endforeach
				
			</div>
			<div class="row" style="padding-top: 7px;">
				 	
				<strong>Nome:</strong> {{ $relatorio->funcionarios()->where("relator", true)->first()->nome }}

			</div>
			
			<div class="row" style="padding-top: 7px;">
				<strong>Matrícula:</strong>{{ $relatorio->funcionarios()->where("relator", true)->first()->matricula }}
				
			</div>
			
			<div class="Imangemsemsop" >
				
				@foreach($imagens as $imagem)

					<img class="semsopimagem" src="{{$imagem->imagem}}" >

				@endforeach
						
			</div>
			{{-- <div class="row" >
				<strong>Imagem:</strong>{{ $relatorio->foto }}
				
			</div>
			 --}}
							
			
		</div> {{-- Fim card --}}
	</div> {{-- Fim col-md-10 --}}
</div> {{-- FIM ROW --}}

@endsection

