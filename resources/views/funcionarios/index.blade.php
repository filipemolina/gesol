@extends('layouts.material')

@section('titulo')

	Funcionários {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">assignment</i>
			</div>

			<div class="card-content">
				<h4 class="card-title">Lista de funcionários</h4>
				<div class="toolbar">
					<!--        Here you can write extra buttons/actions for the toolbar              -->
				</div>
				
				<a href="{{ url("/funcionario/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Adicionar Funcionario"></i></a>

				<div class="material-datatables">
					<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
						<thead>
							<tr>
								<th>Nome</th>
								<th>CPF</th>
								<th>Acesso</th>
								<th>Cargo</th>
								<th class="disabled-sorting text-right">Ações</th>
							</tr>
						</thead>
						<tbody>

							@foreach($funcionarios as $funcionario)

								<tr>
									<td>{{ $funcionario->nome                                            }}</td>
									<td>{{ $funcionario->cpf                                        		}}</td>
									<td>{{ $funcionario->role->acesso                                    }}</td>
									<td>{{ $funcionario->cargo->nome                                    	}}</td>
									<td>

										{{-- se o usuario logado for TI ou DSV habilita a opção de ZERAR a senha --}}
										@if($funcionario_logado->role->peso >= 50)

											@if($funcionario->user['status'] == 'Ativo')
												
												<button  
													class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
													data-toggle="tooltip" 
													data-funcionario = {{ $funcionario->id }}
													data-placement="bottom" 
													title="Desativa a conta do funcionario" >  
													<i class="glyphicon glyphicon-remove "></i>
												</button>

												<button  
													class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
													data-toggle="tooltip" 
													data-funcionario = {{ $funcionario->id }}
													data-placement="bottom" 
													title="Ativa a conta do funcionario"
													style="display: none">  
													<i class="glyphicon glyphicon-plus "></i>
												</button>

											{{-- @elseif($funcionario->user['status'] == 'Inativo') --}}
											@else
												
												<button  
													class="btn_desativa btn btn-danger btn-xs action  pull-right  botao_acao" 
													data-toggle="tooltip" 
													data-funcionario = {{ $funcionario->id }}
													data-placement="bottom" 
													title="Desativa a conta do funcionario" 
													style="display: none">  
													<i class="glyphicon glyphicon-remove "></i>
												</button>

												<button  
													class="btn_ativa btn btn-success btn-xs action  pull-right  botao_acao" 
													data-toggle="tooltip" 
													data-funcionario = {{ $funcionario->id }}
													data-placement="bottom" 
													title="Ativa a conta do funcionario" >  
													<i class="glyphicon glyphicon-plus "></i>
												</button>
											@endif
										@endif

										{{-- se o usuario logado for TI ou DSV habilita a opção de ZERAR a senha --}}
										@if($funcionario_logado->role->peso >= 90)
											<button 
												class="btn_email_senha btn btn-info btn-xs action  pull-right  botao_acao" 
												data-toggle="tooltip" 
												data-funcionario = {{ $funcionario->id }}
												data-placement="bottom" 
												title="Envia NOVA senha por email ao funcionario">  
												<i class="glyphicon glyphicon-envelope "></i>
											</button>
										@endif

										<a href="{{ url("/funcionario/$funcionario->id/edit") }}"
											class="btn btn-warning btn-xs action  pull-right botao_acao " 
											data-toggle="tooltip" 
											data-placement="bottom" 
											title="Edita essa funcionario">  
											<i class="glyphicon glyphicon-pencil "></i>
										</a>

										<a href="{{ url("funcionario/$funcionario->id") }}" 
											class="btn btn-primary btn-xs  action  pull-right botao_acao "  
											data-toggle="tooltip"  
											data-placement="bottom" 
											title="Visualiza as informações do Funcionário"> 
											<i class="glyphicon glyphicon-eye-open "></i>
										</a>
										
										
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


		$("table#datatables").on("click", ".btn_desativa",function(){
			let id_usuario = $(this).data('funcionario');
			let btn = $(this);

			//console.log("botao btn_desativa -> ", $(this).data('funcionario'));
	      swal({
	         title: 'Confirma a DESATIVAÇÃO do funcionário?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o funcionario
   	 	 	$.post('/mudastatus',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_usuario,
   	 	 		status: 	'Inativo'
   	 	 	},function(data){

				 	btn.css('display', 'none').siblings('button.btn_ativa').css('display', 'block');
				 	demo.notificationRight("top", "right", "success", "O funcionário foi Desativado");
 					//console.log(data)

			 	})

         });
      });

		$("table#datatables").on("click", ".btn_ativa",function(){
			let id_usuario = $(this).data('funcionario');
			let btn = $(this);
			//console.log("botao btn_ativa -> ", $(this).data('funcionario'));
	      
	      swal({
	         title: 'Confirma a ATIVAÇÃO do funcionário?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      		//chama a rota para desativar o funcionario
   	 	 	$.post('/mudastatus',{
               _token: 	'{{ csrf_token() }}',
   	 	 		id: 		id_usuario,
   	 	 		status: 	'Ativo'
   	 	 	},function(data){
					
				  	btn.css('display', 'none').siblings('button.btn_desativa').css('display', 'block');

				 	demo.notificationRight("top", "right", "success", "O funcionário foi Ativado");
 					//console.log(data)
			 	})

         });
      });

		$(".btn_email_senha").click(function(){
			let id_usuario = $(this).data('funcionario');

			//console.log("botao btn_email_senha -> ", id_usuario );

	      swal({
	         title: 'Confirma a REINICIALIZAÇÃO da senha do funcionário?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
      	 
      	 	//chama a rota para zerar a senha e enviar email ao funcionário

   	 	 	$.post('/zerarsenhafuncionario',{
                  _token: 	'{{ csrf_token() }}',
      	 	 		id: 		id_usuario
      	 	 		//id: 		id_funcionario
   	 	 	},function(data){
					 //mostrando o retorno do post
				 	demo.notificationRight("top", "right", "success", "Email com nova senha enviado para o funcionário");
 					//console.log(data)
			 	})

         });
      });
     	

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



		$('#datatables').DataTable({
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

			"columnDefs": [
    			{ "width": "15%", "targets": 4 },
    			{ className: "text-center", "targets": [4] },
  			]

        /*"columnDefs": 
        [
          { className: "text-center", "targets": [5] },
          { className: "text-right",  "targets": [2] }
        ]*/
		});
  });
</script>

@endpush