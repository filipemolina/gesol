@extends('layouts.material')

@section('titulo')

	Relatorios {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row" style="max-width: 100%">
	<div class="col-md-12 col-md-offset-0">
		<div class="card" style="padding-left: 6%;">
			<img src="../img/BrasaoTopsemus.png"/>
			<div>
				<h3 style="text-align:center;" >Relatório</h3>
			</div>

			<div class="row" style="padding-top: 7px;">
				
				<strong>Data:</strong> {{ date('d-m-Y', strtotime($relatorio->data)) }} 
				
			</div>

			<div class="row" style="padding-top: 7px;">
				
				<strong>Hora:</strong> {{ $relatorio->hora }} 

			</div>

			<div class="row" style="padding-top: 7px;">
				
			    <strong>Relato:</strong> {{ $relatorio->relato }} 
				
			</div>

			<div class="row" style="padding-top: 7px;">
				<strong>Nome:</strong> {{ $relatorio->funcionario->nome }}
			</div>

			<div class="row" style="padding-top: 7px;">
				<strong>Matrícula:</strong> {{ $relatorio->funcionario->matricula }}
			</div>

			<div class="row" style="padding-top: 7px;">
				<strong>Unidade:</strong> {{ $relatorio->funcionario->setor->nome }}
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

