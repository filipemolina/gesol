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
								</tr>
							</thead>
							 	<tbody>
						 		 @foreach($relatorios as $relatorio)
									<tr>
										{{-- <td>{{ $relatorio->foto }}</td> --}}
										<td>{{ $relatorio->origem }}</td>
										<td>{{ $relatorio->endereco->logradouro }}</td>
									    <td>{{ $relatorio->acao_cop }}</td>
									    <td>{{ $relatorio->relato }}</td>
									    <td>{{ $relatorio->data }} {{$relatorio->hora}}</td>
										<td>{{ $relatorio->funcionarios()->where("relator", true)->first()->nome }}</td>
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