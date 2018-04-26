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

				@if(verificaAtribuicoes(Auth::user()->funcionario,["SEMUS_REL"]))
						<a href="{{ url("/semus/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Novo Relatorio"></i></a>
				@endif
					<div class="material-datatables">
						<table id="relatorios" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
								   <th>Status</th>
								   <th>Relato</th>
								   <th>Data</th> 
								   <th>Unidade</th>
								   <th class="disabled-sorting text-right">Ações</th>
								</tr>
							</thead>
							 <tbody>
								@foreach($relatorios as $relatorio)
						 			<tr>
							 		  <td>@if($relatorio->status) <font color="blue">Solucionado</font> @else <font color="red">Em Andamento</font> @endif</td>
									  <td style="width: 45%;">{{ mb_strimwidth($relatorio->relato, 0, 70,"...") }}</td>
								     <td>{{ date('d-m-Y', strtotime($relatorio->data))}}</td>
								     <td style="width: 21%;">{{ $relatorio->funcionario->setor->nome }} </td>
	        						  <td style="width: 16%;">
											<a href="{{ url("/semus/$relatorio->id")}}" 
												class="btn btn-primary btn-xs  action  pull-right botao_acao"
												data-toggle="tooltip"  
												data-placement="bottom" 
												title="Visualiza o Relatorio detalhado"> 
												<i class="glyphicon glyphicon-eye-open "></i>
											</a>


											<a href="{{action('Semus_RelatorioController@imprimir', $relatorio->id)}}" 
												class="btn btn-info btn-xs action pull-right botao_acao"
												data-toggle="tooltip"  
												data-placement="bottom" 
												title="Imprimir Relatorio"> 
												<i class="glyphicon glyphicon-print"></i>
											</a>
											@if(verificaAtribuicoes(Auth::user()->funcionario,["SEMUS_REL_GERENTE"]))
												@if($relatorio->status == '0')		
												<button
							                        class='btn btn-success btn-xs  action  pull-right botao_acao btn_control btn_solucionar' 
							                        data-toggle='tooltip'
							                        data-placement='bottom'
							                        title='Enviar Relatorio'
							                        data-relatorio = {{$relatorio->id}}> 
							                        <i class='glyphicon glyphicon-ok'></i>
							                    </button>
							                @endif
						               @endif
											 	{{-- <a href="{{ url("semus/$relatorio->id/edit")}}"
													class="btn btn-warning btn-xs action  pull-right botao_acao btn_control" 
													data-toggle="tooltip" 
													data-placement="bottom" 
													title="Editar Relatorio">  
													<i class="glyphicon glyphicon-pencil "></i>
												</a> --}}
											@if($relatorio->funcionario->id == Auth::user()->funcionario->id 
												&& $relatorio->enviado == '0') 
												<button
													class="btn btn-success btn-xs  action  pull-right botao_acao btn_control btn_enviar"  
													data-toggle="tooltip"  
													data-placement="bottom" 
													title="Enviar Relatorio"
													data-relatorio = {{ $relatorio->id }}> 
													<i class="glyphicon glyphicon-ok"></i>
												</button>
														
												<a href="" 
													class="btn btn-danger btn-xs action pull-right botao_acao btn_deletar btn_control"  
													data-toggle="tooltip"  
													data-placement="bottom" 
													title="Excluir Relatorio"
													data-relatorio="{{ $relatorio->id }}"> 
													<i class="glyphicon glyphicon-trash"></i>
												</a>
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

		let tabela = $('#relatorios').DataTable({
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
    			{ "width": "15%", "targets": 3 },
    			{ className: "text-center", "targets": [3] },
  			]

        /*"columnDefs": 
        [
          { className: "text-center", "targets": [5] },
          { className: "text-right",  "targets": [2] }
        ]*/
		});

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
	   	 	 	$.post('semus/enviaformulario',{
	               _token: 	'{{ csrf_token() }}',
	   	 	 		id: 		id,
	   	 	 	},function(data){

					 	btn.css('display', 'block').siblings('button.btnenviar').css('display', 'none');

					 	btn.css('display', 'block').siblings('a.btn_deleta').css('display', 'none');
					 	
					 	demo.notificationRight("top", "right", "success", "O relatório foi enviado");
	 					//console.log(data)

	 					btn.css("display", 'none');
	 					btn.siblings(".btn_control").css("display", 'none');

				 	})

	         });
	      });

		$("table#relatorios").on("click", ".btn_solucionar",function(){
			
			let id = $(this).data('relatorio');
			let btn = $(this);

				//console.log("botao btn_desativa -> ", $(this).data('funcionario'));
		      swal({
		         title: 'Confirma a SOLUÇÃO do Relatório?',
		         type: 'question',
		         showCancelButton: true,
		         confirmButtonColor: '#3085d6',
		         cancelButtonColor: '#d33',
		         confirmButtonText: 'Sim',
		         cancelButtonText: 'Não',
		      }).then(function () {
	      		//chama a rota
	   	 	 	$.post('semus/solucionaformulario',{
	               _token: 	'{{ csrf_token() }}',
	   	 	 		id: 		id,
	   	 	 	},function(data){

					 	btn.css('display', 'block').siblings('button.btn_solucionar').css('display', 'none');
					 	
					 	demo.notificationRight("top", "right", "success", "O relatório foi enviado");
	 					//console.log(data)

	 					btn.css("display", 'none');
	 					btn.siblings(".btn_control").css("display", 'none');
				 	})

				 	window.location.reload();

					// tabela.ajax.reload();
	         });
	      });



		$(".btn_deletar").click(function(e){
			
			// Evitar que a página seja recarregada
			e.preventDefault();

			///////// TACAR O SUAL

				// Obter o ID do relatório
				let id_relatorio = $(this).data('relatorio');

				$("#form_deletar_relatorio").attr('action', "{{url("/")}}/semus/" + id_relatorio);

				$("#form_deletar_relatorio").submit();

			///////// TACAR O SUAL
			
		});

	});

	</script>

<form method="POST" id="form_deletar_relatorio">
	<input type="hidden" name="_method" value="DELETE" />
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>

@endpush
		


