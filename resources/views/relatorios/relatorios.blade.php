@extends('layouts.material')

@section('titulo')

	Relatorios {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">chat bubble</i>
			</div>

			<div class="card-content">
				<h4 class="card-title">Relatorios</h4>
				<div class="toolbar">

				</div>
					
					<a href="{{ url("/semsop/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Novo Relatorio"></i></a>

					<div class="material-datatables">
						<table id="relatorios" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
									<th>Origem</th>
								    <th>Local</th>
									<th>Ação Desenvolvida</th>
									<th>Relato Sucinto</th>
									<th>Data e Hora</th> 
								    <th>Agente/Fiscal</th> 
								    <th class="disabled-sorting text-right">Ações</th>
								</tr>
							</thead>
							 	<tbody>
						 		 @foreach($relatorios as $relatorio)
									<tr>
										{{-- <td>{{ $relatorio->foto }}</td> --}}
										<td>{{ $relatorio->origem }}</td>
										<td>{{ $relatorio->endereco->logradouro }}</td>
									    <td>{{ $relatorio->acao_cop }} {{ $relatorio->acao_gcmm }}</td>
									    <td>{{ $relatorio->relato }}</td>
									    <td>{{ $relatorio->data }} {{$relatorio->hora}}</td>
										<td>{{ $relatorio->funcionarios()->where("relator", true)->first()->nome }}</td>

									<td><a href="{{ url("/semsop/$relatorio->id")}}" 
											class="btn btn-primary btn-xs  action  pull-right botao_acao "  
											data-toggle="tooltip"  
											data-placement="bottom" 
											title="Visualiza o Relatorio detalhado"> 
											<i class="glyphicon glyphicon-eye-open "></i>
										</a> 
										<a href="{{ url("semsop/$relatorio->id/edit")}}"
											class="btn btn-warning btn-xs action  pull-right botao_acao " 
											data-toggle="tooltip" 
											data-placement="bottom" 
											title="Edita Relatorio antes de enviar">  
											<i class="glyphicon glyphicon-pencil "></i>
										</a>
										<a href="" 
											class="btn btn-primary btn-xs  action  pull-right botao_acao "  
											data-toggle="tooltip"  
											data-placement="bottom" 
											title="Imprimir Relatorio"> 
											<i class="glyphicon glyphicon-print"></i>
										<a href="" 
											class="btn btn-success btn-xs  action  pull-right botao_acao "  
											data-toggle="tooltip"  
											data-placement="bottom" 
											title="Enviar Relatorio"> 
											<i class="glyphicon glyphicon-ok"></i>
										<a href="" 
											class="btn btn-danger btn-xs  action  pull-right botao_acao "  
											data-toggle="tooltip"  
											data-placement="bottom" 
											title="Excluir Relatorio"> 
											<i class="glyphicon glyphicon-remove"></i>
									</tr>
								@endforeach    
							</tbody> 
						</table>

					</div> {{-- Fim Material-datatbles --}}

			</div> {{-- Fim card-content --}}
		</div> {{-- Fim card --}}
	</div> {{-- Fim col-md-10 --}}
</div> {{-- FIM ROW --}}

@endsection

@push('scripts')

{{-- 	<script type="text/javascript">

			$(document).ready( function () {
	   		 $('#relatorios').DataTable({
	   	

			 	language : 
		    	{
		        "url":         "{{ asset('js/portugues.json') }}",
		        "decimal":     ",",
		        "thousands":   "."
		    	}
	   	   });
		});

	</script> --}}

@endpush