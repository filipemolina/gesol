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
				<div class="toolbar"></div>
					@if(verificaAtribuicoes(Auth::user()->funcionario,["SEMSOP_REL_GCMM","SEMSOP_REL_FISCAL"]))
						<a href="{{ url("/semsop/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Novo Relatorio"></i></a>
					@endif
					<div class="material-datatables">
						<table id="relatorios" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
									<th>Origem</th>
								   <th>Local</th>
									<th>Numero</th>
									<th>Relato Sucinto</th>
									<th>Data</th> 
								   <th>Agente/Fiscal</th> 
								   <th class="disabled-sorting text-right" style="width: 16%;">Ações</th>
								</tr>
							</thead>
							 	{{-- Preenchido com DataTables --}}
						</table>

					</div> {{-- Fim Material-datatbles --}}

			</div> {{-- Fim card-content --}}
		</div> {{-- Fim card --}}
	</div> {{-- Fim col-md-10 --}}
</div> {{-- FIM ROW --}}

@endsection

@push('scripts')

	<script type="text/javascript"> 
	$(document).ready(function() {
		$("table#relatorios").on("click", ".btn_enviar",function(){
			
			let id = $(this).data('relatorio');
			let btn = $(this);

				//console.log("botao btn_desativa -> ", $(this).data('funcionario'));
		      swal({
		         title: 'Confirma o ENVIO do Relatório?',
		         type: 'question',
		         showCancelButton: true,
		         confirmButtonColor: '#3085d6',
		         cancelButtonColor: '#d33',
		         confirmButtonText: 'Sim',
		         cancelButtonText: 'Não',
		      }).then(function () {
	      		//chama a rota
	   	 	 	$.post('semsop/enviaformulario',{
	               _token: 	'{{ csrf_token() }}',
	   	 	 		id: 		id,
	   	 	 	},function(data){

					 	btn.css('display', 'block').siblings('button.btnenviar').css('display', 'none');

					 	btn.css('display', 'block').siblings('a.btn_deleta').css('display', 'none');

					 	btn.css('display', 'block').siblings('a.btn_edit').css('display', 'none');
					 	
					 	demo.notificationRight("top", "right", "success", "O relatório foi enviado");
	 					//console.log(data)

	 					btn.css("display", 'none');
	 					btn.siblings(".btn_control").css("display", 'none');

				 	})

	         });
	      });

		$("body").on("click", "a.btn_deletar",function(e){

			// Obter o ID do relatório
				let id_relatorio = $(this).data('relatorio');

			// Evitar que a página seja recarregada	
				e.preventDefault();

			swal({
		         title: 'Confirma a EXCLUSÃO do Relatório?',
		         type: 'question',
		         showCancelButton: true,
		         confirmButtonColor: '#3085d6',
		         cancelButtonColor: '#d33',
		         confirmButtonText: 'Sim',
		         cancelButtonText: 'Não',
		      }).then(function(){

				 $("#form_deletar_relatorio").attr('action', "{{url("/")}}/semsop/" + id_relatorio);

				 $("#form_deletar_relatorio").submit();

				});
		});

		$('#relatorios').DataTable({
			language : {
        'url' : '{{ asset('js/portugues.json') }}',
        "decimal": ",",
        "thousands": "."
      },
    	stateSave: true,
    	stateDuration: -1,
			responsive: true,
			deferRender: true,
			compact: true,
			serverSide: true,
			ajax: "{{ url('/semsop/datatables') }}",
			columns: [
				{ data : 'origem',        name : 'origem' },
				{ data : 'local',        name : 'local' },
				{ data : 'numero',        name : 'numero' },
				{ data : 'relato',        name : 'relato' },
				{ data : 'data',        name : 'data' },
				{ data : 'agente',        name : 'agente' },
				{ data : 'acoes',        name : 'acoes' },
			],
			"columnDefs": [
    			{ "width": "15%", "targets": 5 },
    			{ className: "text-center", "targets": [5] },
  			]
		});
	});

	</script>

<form method="POST" id="form_deletar_relatorio">
	<input type="hidden" name="_method" value="DELETE" />
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>

@endpush
