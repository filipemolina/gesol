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
				
						<a href="{{ url("/semus/create")}}" class="btn btn-dourado btn-just-icon btn-round fixo-direita"><i class="mdi mdi-plus" rel="tooltip" data-placement="left" title="Novo Relatorio"></i></a>
				
					<div class="material-datatables">
						<table id="relatorios" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
							<thead>
								<tr>
								   <th>Prioridade</th>
								   <th>Unidade</th>
								   <th>Relato</th>
								   <th>Responsavel</th>
								   <th>Data</th> 
								   <th class="disabled-sorting text-right">Ações</th>
								</tr>
							</thead>
							 <tbody>
						 		 @foreach($relatorios as $relatorio)
						 		 <tr>
									<td>{{ $relatorio->prioridade }}</td>
								   <td>{{ $relatorio->unidade}}</td>
								   <td>{{ mb_strimwidth($relatorio->relato, 0, 70,"...") }}</td>
								   <td>{{ $relatorio->responsavel}}</td>
							      <td style="width: 9%;">{{ date('d-m-Y', strtotime($relatorio->data))}}</td>
								
        								<td style="width: 16%;">
											<a href="" 
												class="btn btn-primary btn-xs  action  pull-right botao_acao "  
												data-toggle="tooltip"  
												data-placement="bottom" 
												title="Visualiza o Relatorio detalhado"> 
												<i class="glyphicon glyphicon-eye-open "></i>
											</a> 
											
											<a href="" 
												class="btn btn-info btn-xs action pull-right botao_acao"
												data-toggle="tooltip"  
												data-placement="bottom" 
												title="Imprimir Relatorio"> 
												<i class="glyphicon glyphicon-print"></i>
											</a>

												<a href=""
													class="btn btn-warning btn-xs action  pull-right botao_acao btn_control" 
													data-toggle="tooltip" 
													data-placement="bottom" 
													title="Editar Relatorio">  
													<i class="glyphicon glyphicon-pencil "></i>
												</a>
												
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

@endpush
		