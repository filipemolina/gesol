@extends('layouts.material')

@section('titulo')

	Comunicados {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">chat bubble</i>
			</div>

			<div class="card-content">
				<h4 class="card-title">Lista de Comunicados</h4>
				<div class="toolbar">
					<!--        Here you can write extra buttons/actions for the toolbar              -->
				</div>

				
				<!-- testa se o funcionário tem a ATRIBUIÇÃO de COMUNICADOR para poder enviar comunicados -->
				@if($funcionario_logado->atribuicoes()->where('atribuicao', 'COMUNICADOR')->count() )      
					<a href="{{ url("/comunicado/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Novo Comunicado"></i></a>
					<div class="material-datatables">
						<table id="comunicados" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
									<th>Imagem</th>
									<th>Título</th>
									<th>Subtitulo</th>
									<th>Texto</th>
									<th>Momento</th>
									<th>Alcance</th>
									<th>Ações</th>
									{{-- Preenchido com Datatables --}}
								</tr>
							</thead>
						</table>
					</div> {{-- Fim Material-datatbles --}}
				@else
					<div class="material-datatables">
						<table id="comunicados" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
									<th>Imagem</th>
									<th>Título</th>
									<th>Subtitulo</th>
									<th>Texto</th>
									<th>Momento</th>
									{{-- Preenchido com Datatables --}}
								</tr>
							</thead>
						</table>
					</div> {{-- Fim Material-datatbles --}}

				@endif

			</div> {{-- Fim card-content --}}
		</div> {{-- Fim card --}}
	</div> {{-- Fim col-md-10 --}}
</div> {{-- FIM ROW --}}

@endsection

@push('scripts')

	<script type="text/javascript">

		let tabela;
		
		$(function(){

			// DataTables
			tabela = $("table#comunicados").DataTable({
				responsive : true,
	        	processing: true,
	        	serverSide: true,
	        	ajax      : "{{ url('/comunicado/datatables') }}",

	        	
	        	columns   : [
	            { data : 'imagem',       name : 'imagem' },
					{ data : 'titulo',       name : 'titulo' },
					{ data : 'subtitulo',    name : 'subtitulo' },
					{ data : 'texto',        name : 'texto' },
					{ data : 'momento',      name : 'momento' },

					{{--  teste se é COMUNICADOR  --}}
					@if( $funcionario_logado->atribuicoes()->where('atribuicao', 'COMUNICADOR')->count() )
					
	            	{ data : 'alcance',      name : 'alcance' },
						{ data : 'acoes',      	 name : 'acoes' },
					@endif
	        	],
	        	language : 
	        	{
	            "url":         "{{ asset('js/portugues.json') }}",
	            "decimal":     ",",
	            "thousands":   "."
	        	},
	        	stateSave: true,
	        	// stateDuration: -1,
	        	columnDefs: 
	        	[
	            { className:   "text-center", "targets": [0] },
	            { className:   "text-center", "targets": [1] },
	            { className:   "text-center", "targets": [3] },
					{ className:   "text-center", "targets": [4] },
					
					{ width:       "8%",          "targets": [0] },
					{ width:       "10%",         "targets": [1] },
					{ width:       "10%",         "targets": [2] },
					{ width:       "20%",         "targets": [3] },
					{ width:       "5%",          "targets": [4] },
					
					{{--  teste se é COMUNICADOR  --}}
					@if( $funcionario_logado->atribuicoes()->where('atribuicao', 'COMUNICADOR')->count() )
						{ width:       "5%",          "targets": [5] },
						{ width:       "5%",          "targets": [6] },
					@endif
					
					
	        	],
	        	order : [
	        		[2, 'desc'],
	        		[3, 'desc']
	        	]
			});


			// Código para exclusão de um comunicado

			$("table#comunicados").on('click', 'a.btn-excluir', function(){

				let id = $(this).data('id');

				swal({
					title: 'Deseja realmente excluir esse comunicado?',
		            text: "Ele não poderá mais ser visto nos dispositivos com o Mesquita 360º instalados e não poderá ser recuperado",
		            type: 'warning',
		            showCancelButton: true,
		            confirmButtonColor: '#3085d6',
		            cancelButtonColor: '#d33',
		            confirmButtonText: 'Sim!'	
				}).then(function(){

					// Realizar a chamada Ajax para excluir o comunicado
					$.post("{{ url("/comunicado/") }}/"+id, { _method: "DELETE", _token: "{{ csrf_token() }}" }, function(){

						swal('Comunicado Excluído!', '', 'success')
						.then(function(){

							tabela.ajax.reload();

						});

					});

				});

			});

		});

	</script>

@endpush