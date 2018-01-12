@extends('layouts.material')

@section('titulo')

	Configurações - Setores {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">assignment</i>
			</div>

			<div class="card-content">
				<h4 class="card-title">Lista de Setores</h4>
				<div class="toolbar">
					<!--        Here you can write extra buttons/actions for the toolbar              -->
				</div>
				
				<a href="{{ url("/setor/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Adicionar Setor"></i></a>

				<div class="material-datatables">
					<table id="datatable_setor" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
						<thead>
							<tr>
								<th>Secretaria</th>
								<th>Setor</th>
								
								<th class="disabled-sorting text-right">Ações</th>
							</tr>
						</thead>
						<tbody>

							@foreach($setores as $setor)
								<tr>
									<td>{{ $setor->secretaria->nome                            	}}</td>
									<td>{{ $setor->nome                           					}}</td>
									
									<td>
										<a href="{{ url("/setor/$setor->id/edit") }}"
											class="btn btn-warning btn-xs action  pull-right botao_acao " 
											data-toggle="tooltip" 
											data-placement="bottom" 
											title="Edita esse Setor">  
											<i class="glyphicon glyphicon-pencil "></i>
										</a>

										@if($setor->operante == true)
												
											<button  
												class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title="Desativa o Setor" >  
												<i class="glyphicon glyphicon-remove "></i>
											</button>

											<button  
												class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title="Ativa o Setor"
												style="display: none">  
												<i class="glyphicon glyphicon-plus "></i>
											</button>

										{{-- @elseif($setor->status == 'Inativa') --}}
										@else
											
											<button  
												class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title="Desativa o Setor" 
												style="display: none">  
												<i class="glyphicon glyphicon-remove "></i>
											</button>

											<button  
												class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title="Ativa o Setor" >  
												<i class="glyphicon glyphicon-plus "></i>
											</button>
										@endif

										@if($setor->oculto == true)
											<button  
												class="btn_mostra btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title='Deixa o Setor visível no "Mesquita 360" ' >  
												<i class="glyphicon glyphicon-eye-open"></i>
											</button>

											<button  
												class="btn_oculta btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title='Oculta o Setor no "Mesquita 360\" '   
												style="display: none">  
												<i class="glyphicon glyphicon-eye-close"></i>
												
											</button>

										{{-- @elseif($setor->status == 'Inativa') --}}
										@else
											
											<button  
												class="btn_mostra btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title='Deixa o Setor visível no "Mesquita 360" '   
												style="display: none">  
												<i class="glyphicon glyphicon-eye-open"></i>
											</button>

											<button  
												class="btn_oculta btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-setor = {{ $setor->id }}
												data-placement="bottom" 
												title='Oculta o Setor no "Mesquita 360" '>
												
												<i class="glyphicon glyphicon-eye-close"></i>
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

		$('#datatable_setor').DataTable({
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

		 	"order": [[ 0, 'asc' ], [ 1, 'asc' ]],
		});



		$.fn.dataTable.moment( 'DD/MM/YYYY' );


		$("table#datatable_setor").on("click", ".btn_desativa",function(){
			let id_setor = $(this).data('setor');
			let btn = $(this);

			console.log("botao btn_desativa -> ", $(this).data('setor'));
	      swal({
	         title: 'Confirma a DESATIVAÇÃO da Setor?',
	         text: "Essa alteração será refletida no \"Mesquita 360\"!",
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o setor
   	 	 	$.post('/mudastatus_setor',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_setor,
   	 	 		status: 	false
   	 	 	},function(data){

				 	btn.css('display', 'none').siblings('button.btn_ativa').css('display', 'block');
				 	demo.notificationRight("top", "right", "success", "A Secretaria foi desativada");
 					console.log(data)

			 	})

         });
      });

		$("table#datatable_setor").on("click", ".btn_ativa",function(){
			let id_setor = $(this).data('setor');
			let btn = $(this);
			console.log("botao btn_ativa -> ", $(this).data('setor'));
	      
	      swal({
	         title: 'Confirma a ATIVAÇÃO do Setor?',
	         text: "Essa alteração será refletida no \"Mesquita 360\"!",
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o setor
   	 	 	$.post('/mudastatus_setor',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_setor,
   	 	 		status: 	true
   	 	 	},function(data){
					
				  	btn.css('display', 'none').siblings('button.btn_desativa').css('display', 'block');

				 	demo.notificationRight("top", "right", "success", "A Secretaria foi Ativada");
 					console.log(data)
			 	})

         });
      });

		//=======================================================================================
		// ROTINA DE MOSTRAR/CULTAR O SETOR NO 360 DE ACORDO COM O BOTÃO ACIONADO NO DATATABLES
		//=======================================================================================
		$("table#datatable_setor").on("click", ".btn_oculta",function(){
			let id_setor = $(this).data('setor');
			let btn = $(this);

			console.log("botao btn_oculta -> ", $(this).data('setor'));
	      swal({
	         title: 'Confirma a OCULTAÇÃO do Setor no "Mesquita 360"?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o setor
   	 	 	$.post('/mudavisualizacao_setor',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_setor,
   	 	 		oculto: 	1
   	 	 	},function(data){

				 	btn.css('display', 'none').siblings('button.btn_mostra').css('display', 'block');
				 	demo.notificationRight("top", "right", "success", "A Setor foi Ocultado");
 					console.log(data)

			 	})

         });
      });

		$("table#datatable_setor").on("click", ".btn_mostra",function(){
			let id_setor = $(this).data('setor');
			let btn = $(this);
			console.log("botao btn_mostra -> ", $(this).data('setor'));
	      
	      swal({
	         title: 'Confirma deixar VISÍVEL o Setor no "Mesquita 360"?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o setor
   	 	 	$.post('/mudavisualizacao_setor',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_setor,
   	 	 		oculto: 	0
   	 	 	},function(data){
					
				  	btn.css('display', 'none').siblings('button.btn_oculta').css('display', 'block');

				 	demo.notificationRight("top", "right", "success", "A Secretaria está Visível");
 					console.log(data)
			 	})

         });
      });

		//FIM ROTINA

  });
</script>

@endpush