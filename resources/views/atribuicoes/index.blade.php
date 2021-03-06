@extends('layouts.material')

@section('titulo')

	Atribuições {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="row">
	<div class="col-md-12 col-md-offset-0">
		<div class="card">
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">compare_arrows</i>
			</div>

			<div class="card-content">
				<h4 class="card-title">Lista de Atribuições / Funcionarios </h4>
				<div class="toolbar">
					<!--        Here you can write extra buttons/actions for the toolbar              -->
				</div>
				
				<a href="{{ url("/funcionario/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Adicionar Funcionario"></i></a>

				<div class="col-md-6">
					<div class="material-datatables">
						<table id="tb_atribuicao" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
									<th>Atribuição</th>
									<th class="disabled-sorting text-right">Ações</th>
								</tr>
							</thead>
							<tbody>

								@foreach($atribuicoes as $atribuicao)
									<tr>
										<td>{{ $atribuicao->descricao  }}</td>
										<td>
											<a href="{{ url("/atribuicao/$atribuicao->id/edit") }}"
												class="btn btn-warning btn-xs action  pull-right botao_acao " 
												data-toggle="tooltip" 
												data-placement="bottom" 
												title="Edita essa funcionario">  
												<i class="glyphicon glyphicon-pencil "></i>
											</a>

											<a href="{{ url("atribuicao/$atribuicao->id") }}" 
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
				</div>
				
				<div class="col-md-6">
					<div class="material-datatables">
						<table id="tb_funcionario" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Secretaria</th>
									<th>Acesso</th>
									<th class="disabled-sorting text-right">Ações</th>
								</tr>
							</thead>
							<tbody>

								@foreach($funcionarios as $funcionario)

									<tr>
										<td>{{ $funcionario->nome                      }}</td>
										<td>{{ $funcionario->setor->secretaria->sigla  }}</td>
										<td>{{ $funcionario->setor->nome               }}</td>

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
				</div>

				
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


		$('#tb_atribuicao').DataTable({
			language : {'url' : '{{ asset('js/portugues.json') }}',"decimal": ",","thousands": "."}, 
        	stateSave: true,
        	stateDuration: -1,
			responsive: true,
			deferRender: true,
			compact: true,
			
			paginate: false,

			"columnDefs": [
    			{ "width": "15%", "targets": 1 },
    			{ "className": "text-center", "targets": [1] },
  			]

		});
  });
</script>

@endpush