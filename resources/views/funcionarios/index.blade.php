@extends('layouts.material')

@section('titulo')

Funcionários

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
								<th>E-mail</th>
								<th>CPF</th>
								<th>Matrícula</th>
								<th>Cargo</th>
								<th>Acesso</th>
								<th class="disabled-sorting text-right">Ações</th>
							</tr>
						</thead>
						<tbody>
							@foreach($funcionarios as $funcionario )
							<tr>
								<td>{{ $funcionario->nome                                             }}</td>
								<td>{{ $funcionario->user->email                                      }}</td>
								<td>{{ $funcionario->cpf                                        		 }}</td>
								<td>{{ $funcionario->matricula                                        }}</td>
								<td>{{ $funcionario->cargo                                            }}</td>
								<td>{{ $funcionario->role->acesso                              		 }}</td>
								<td>
									<a href="{{ url("/funcionario/$funcionario->id/edit") }}"
										class="btn btn-warning btn-xs action botao_lista pull-right " 
										data-toggle="tooltip" 
										data-placement="bottom" 
										title="Edita essa funcionario">  
										<i class="glyphicon glyphicon-pencil icone_botao_lista"></i>
									</a>


									<a href="{{ url("funcionarios/$funcionario->id") }}" 
										class="btn btn-primary btn-xs  action botao_lista pull-right "  
										data-toggle="tooltip"  
										data-placement="bottom" 
										title="Visualiza essa Loja"> 
										<i class="glyphicon glyphicon-eye-open icone_botao_lista"></i>
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

        /*"columnDefs": 
        [
          { className: "text-center", "targets": [5] },
          { className: "text-right",  "targets": [2] }
        ]*/
		});


		
  });
</script>

  @endpush