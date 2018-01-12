@extends('layouts.material')

@section('titulo')

	Configurações - Secretarias {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">assignment</i>
			</div>

			<div class="card-content">
				<h4 class="card-title">Lista de Secretarias</h4>
				<div class="toolbar">
					<!--        Here you can write extra buttons/actions for the toolbar              -->
				</div>
				
				<a href="{{ url("/secretaria/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Adicionar Secretaria"></i></a>

				<div class="material-datatables">
					<table id="datatable_secretaria" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
						<thead>
							<tr>
								<th>Nome</th>
								<th>Sigla</th>
								<th>Secretario</th>
								<th class="disabled-sorting text-right">Ações</th>
							</tr>
						</thead>
						<tbody>

							@foreach($secretarias as $secretaria)
								<tr>
									<td>{{ $secretaria->nome                                             }}</td>
									<td>{{ $secretaria->sigla                                      		}}</td>
									<td>{{ $secretaria->secretario                                     	}}</td>
									<td>
										<a href="{{ url("/secretaria/$secretaria->id/edit") }}"
											class="btn btn-warning btn-xs action  pull-right botao_acao " 
											data-toggle="tooltip" 
											data-placement="bottom" 
											title="Edita essa Secretaria">  
											<i class="glyphicon glyphicon-pencil "></i>
										</a>

										@if($secretaria->operante == true)
												
											<button  
												class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-secretaria = {{ $secretaria->id }}
												data-placement="bottom" 
												title="Desativa a Secretaria" >  
												<i class="glyphicon glyphicon-remove "></i>
											</button>

											<button  
												class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-secretaria = {{ $secretaria->id }}
												data-placement="bottom" 
												title="Ativa a Secretaria"
												style="display: none">  
												<i class="glyphicon glyphicon-plus "></i>
											</button>

										{{-- @elseif($secretaria->status == 'Inativa') --}}
										@else
											
											<button  
												class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-secretaria = {{ $secretaria->id }}
												data-placement="bottom" 
												title="Desativa a Secretaria" 
												style="display: none">  
												<i class="glyphicon glyphicon-remove "></i>
											</button>

											<button  
												class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-secretaria = {{ $secretaria->id }}
												data-placement="bottom" 
												title="Ativa a Secretaria" >  
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

		$('#datatable_secretaria').DataTable({
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
    			{ "width": "15%", "targets": 3 },
    			{ className: "text-center", "targets": [3] },
  			]
		});



		$.fn.dataTable.moment( 'DD/MM/YYYY' );


		$("table#datatable_secretaria").on("click", ".btn_desativa",function(){
			let id_secretaria = $(this).data('secretaria');
			let btn = $(this);

			console.log("botao btn_desativa -> ", $(this).data('secretaria'));
	      swal({
	         title: 'Confirma a DESATIVAÇÃO da Secretaria?',
	         text: "Essa alteração será refletida no \"Mesquita 360\"!",
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o secretaria
   	 	 	$.post('/mudastatus_secretaria',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_secretaria,
   	 	 		operante: 	0
   	 	 	},function(data){

				 	btn.css('display', 'none').siblings('button.btn_ativa').css('display', 'block');
				 	demo.notificationRight("top", "right", "success", "A Secretaria foi desativada");
 					console.log(data)

			 	})

         });
      });

		$("table#datatable_secretaria").on("click", ".btn_ativa",function(){
			let id_secretaria = $(this).data('secretaria');
			let btn = $(this);
			console.log("botao btn_ativa -> ", $(this).data('secretaria'));
	      
	      swal({
	         title: 'Confirma a ATIVAÇÃO da Secretaria?',
	         text: "Essa alteração será refletida no \"Mesquita 360\"!",
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o secretaria
   	 	 	$.post('/mudastatus_secretaria',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_secretaria,
   	 	 		operante: 1
   	 	 	},function(data){
					
				  	btn.css('display', 'none').siblings('button.btn_desativa').css('display', 'block');

				 	demo.notificationRight("top", "right", "success", "A Secretaria foi Ativada");
 					console.log(data)
			 	})

         });
      });

  });
</script>

@endpush