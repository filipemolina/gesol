@extends('layouts.material')

@section('titulo')

	Configurações - Serviços {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">build</i>
			</div>

			<div class="card-content">
				<h4 class="card-title">Lista de Serviços</h4>
				<div class="toolbar">
					<!--        Here you can write extra buttons/actions for the toolbar              -->
				</div>
				
				<a href="{{ url("/servico/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Adicionar Serviço"></i></a>

				<div class="material-datatables">
					<table id="datatable_servico" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
						<thead>
							<tr>
								<th>Secretaria</th>
								<th>Setor</th>
								<th>Serviço</th>
								
								<th class="disabled-sorting text-right">Ações</th>
							</tr>
						</thead>
						<tbody>

							@foreach($servicos as $servico)
								<tr>
									<td>{{ $servico->setor->secretaria->nome                            	}}</td>
									<td>{{ $servico->setor->nome                           					}}</td>
									<td>{{ $servico->nome                           							}}</td>
									
									<td>
										<a href="{{ url("/servico/$servico->id/edit") }}"
											class="btn btn-warning btn-xs action  pull-right botao_acao " 
											data-toggle="tooltip" 
											data-placement="bottom" 
											title="Edita esse Serviço">  
											<i class="glyphicon glyphicon-pencil "></i>
										</a>

										@if($servico->operante == true)
												
											<button  
												class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-servico = {{ $servico->id }}
												data-placement="bottom" 
												title="Desativa o Serviço" >  
												<i class="glyphicon glyphicon-remove "></i>
											</button>

											<button  
												class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-servico = {{ $servico->id }}
												data-placement="bottom" 
												title="Ativa o Serviço"
												style="display: none">  
												<i class="glyphicon glyphicon-plus "></i>
											</button>

										{{-- @elseif($servico->status == 'Inativa') --}}
										@else
											
											<button  
												class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-servico = {{ $servico->id }}
												data-placement="bottom" 
												title="Desativa o Serviço" 
												style="display: none">  
												<i class="glyphicon glyphicon-remove "></i>
											</button>

											<button  
												class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-servico = {{ $servico->id }}
												data-placement="bottom" 
												title="Ativa o Serviço" >  
												<i class="glyphicon glyphicon-plus "></i>
											</button>
										@endif

										

									</td>
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

<script type="text/javascript">
	$(document).ready(function() {
		$.fn.dataTable.moment( 'DD/MM/YYYY' );
		
		{{-- Testar se há algum erro, e mostrar a notificação --}}
		@if ($errors->any())
		 	@foreach ($errors->all() as $error)
		    	setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
		    	tempo += incremento;
		 	@endforeach
			@endif

			@if (isset($sucesso))
		 
			demo.notificationRight("top", "right", "success", "{{ $error }}");
		@endif


		@if (session('sucesso'))
			demo.notificationRight("top", "right", "success", "{{ session('sucesso') }}");
		@endif

		$('#datatable_servico').DataTable({
			language : {
                      'url' : '{{ asset('js/portugues.json') }}',
                      "decimal": ",",
                      "thousands": "."
                    }, 
        	stateSave: true,
        	
			responsive: true,
			deferRender: true,
			compact: true,

			"columnDefs": [
    			{ "width": "15%", "targets": 2 },
    			{ className: "text-center", "targets": [2] },
  			],

		 	"order": [[ 0, 'asc' ], [ 1, 'asc' ], [ 3, 'asc' ]],
		});


		$.fn.dataTable.moment( 'DD/MM/YYYY' );

		$("table#datatable_servico").on("click", ".btn_desativa",function(){
			let id_servico = $(this).data('servico');
			let btn = $(this);

			console.log("botao btn_desativa -> ", $(this).data('servico'));
	      swal({
	         title: 'Confirma a DESATIVAÇÃO do Serviço?',
	         text: "Essa alteração será refletida no \"Mesquita 360\"!",
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o servico
   	 	 	$.post('/MudaStatus_Servico',{
               _token: 		'{{ csrf_token() }}',
   	 	 		id: 			id_servico,
   	 	 		operante: 	0
   	 	 	},function(data){

				 	btn.css('display', 'none').siblings('button.btn_ativa').css('display', 'block');
				 	demo.notificationRight("top", "right", "success", "O Serviço foi desativado");
 					console.log(data)

			 	})

         });
      });

		$("table#datatable_servico").on("click", ".btn_ativa",function(){
			let id_servico = $(this).data('servico');
			let btn = $(this);
			console.log("botao btn_ativa -> ", $(this).data('servico'));
	      
	      swal({
	         title: 'Confirma a ATIVAÇÃO do servico?',
	         text: "Essa alteração será refletida no \"Mesquita 360\"!",
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o servico
   	 	 	$.post('/MudaStatus_Servico',{
               _token: 		'{{ csrf_token() }}',
   	 	 		id: 			id_servico,
   	 	 		operante: 	1
   	 	 	},function(data){
					
				  	btn.css('display', 'none').siblings('button.btn_desativa').css('display', 'block');

				 	demo.notificationRight("top", "right", "success", "O Serviço foi Ativado");
 					console.log(data)
			 	})
         });
      });
  	});
</script>

@endpush