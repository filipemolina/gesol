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
										</td>
									</tr>   
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
		


'CMS Paraná',
'ESF Walter Borges',
'Farmácia & Laboratório Municipal',
'Laboratório Central de Mesquita',
'Policlínica Municipal Celestina José Ricardo Rosa',
'PSF Edson Passos',
'PSF Jacutinga',
'PSF Maria Cristina',
'PSF Santo Elias',
'PSF Sete Anões',
'SAMU',
'UBS Alto Uruguai',
'UBS Banco de Areia',
'UBS BNH',
'UBS Coréia',
'UBS Cosmorama',
'UBS Edson Passos',
'UBS França Leite',
'UBS Jorge Campos',
'UBS Juscelino',
'UBS Nossa Senhora Das Graças',
'UBS Parque Ludolf',
'UBS Santa Terezinha',
'UBS Vila Emil II',
'UBS Vila Norma',
'Unidade de Saúde Dr. Mário Bento'