@extends('layouts.material')

@section('titulo')

	Relatorios

@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-success card-header-icon">
				<div class="card-icon" style="background: linear-gradient(60deg, #BFA15F, #ad7909);box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(191, 161, 95, 0.4);">
					<i class="material-icons">chat bubble</i>
				</div>
				<h4 class="card-title">Relatorios</h4>
					@if($guarda)
						<a href="{{ url("/semsop/create")}}" class="btn btn-dourado btn-just-icon btn-round" style="float: right;top: -33px;right: -13px;"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Novo Relatorio"></i></a>					
					@endif
			</div>
			<div class="card-body">
				<div class="toolbar"></div>
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
					</table>
				</div> {{-- Fim Material-datatbles --}}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
	
    {{-- Sweet Alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script type="text/javascript"> 

		$(document).ready(function() {
			
			$("table#relatorios").on("click", ".btn_enviar",function(){
			
				let id = $(this).data('relatorio');
				// console.log(id);
				let btn = $(this);

				//console.log("botao btn_desativa -> ", $(this).data('funcionario'));
		      	swal({
		         title: "Atenção!",
		         text: 'Confirma o ENVIO do Relatório?',
		       icon: "warning",
                buttons: {
                  cancel: {
                    text: "Cancelar",
                    value: "cancelar",
                    visible: true,
                    closeModal: true,
                  },
                  ok: {
                    text: "Sim, Enviar!",
                    value: 'enviar',
                    visible: true,
                    closeModal: true,
                  }
                }
		      	}).then(function (resultado) {

		      		 if(resultado === 'enviar'){

	      		//chama a rota
	   	 	 	$.post('semsop/enviaformulario',{
	               _token: 	'{{ csrf_token() }}',
	   	 	 		id: 		id,
	   	 	 	},function(data){

					console.log(data);
					btn.css('display', 'block').siblings('button.btnenviar').css('display', 'none');

					btn.css('display', 'block').siblings('a.btn_deleta').css('display', 'none');

					btn.css('display', 'block').siblings('a.btn_edit').css('display', 'none');
					
					demo.notificationRight("top", "right", "success", "O relatório foi enviado");
					//console.log(data)

					btn.css("display", 'none');
					btn.siblings(".btn_control").css("display", 'none');

				 	}).done(function(){

                      //Recarregar a página
                      location.reload();
                    });

                 };
	      	});

		});

		$("body").on("click", "a.btn_deletar",function(e){

			// Evitar que a página seja recarregada	
				e.preventDefault();
			// Obter o ID do relatório
				let id_relatorio = $(this).data('relatorio');


			swal({
		        title: "Atenção!",
		        text: 'Confirma a EXCLUSÃO do Relatório?',
		        icon: "warning",
		        buttons: {
                  cancel: {
                    text: "Cancelar",
                    value: "cancelar",
                    visible: true,
                    closeModal: true,
                  },
                  ok: {
                    text: "Sim, excluir!",
                    value: 'excluir',
                    visible: true,
                    closeModal: true,
                  }
                }
		      }).then(function(resultado){

		      	 if(resultado === 'excluir'){

		      	 	// Chamando a url /usuarios/id usando método DELETE e a token de segurança
                    
                    $.post("{{ url("/semsop/") }}/"+id_relatorio, {
                      id : id_relatorio,
                      _method : "DELETE",
                      _token : "{{ csrf_token() }}",
                    }).done(function(){

                      //Recarregar a página
                      location.reload();
                    });

                } 

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
