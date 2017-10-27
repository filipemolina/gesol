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

				<div class="material-datatables">
					<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
						<thead>
							<tr>
								<th>Nome</th>
								<th>E-mail</th>
								<th>CPF</th>
								<th>Matrícula</th>
								<th>Cargo</th>
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
		$('#datatables').DataTable({
			"pagingType": "full_numbers",
			"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
			],
			responsive: true,
			language: {
				search: "_INPUT_",
				searchPlaceholder: "Search records",
			}

		});


		var table = $('#datatables').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
        	$tr = $(this).closest('tr');

        	var data = table.row($tr).data();
        	alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
        	$tr = $(this).closest('tr');
        	table.row($tr).remove().draw();
        	e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
        	alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');
     });
  </script>

  @endpush