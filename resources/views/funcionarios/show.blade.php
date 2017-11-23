@extends("layouts.material")

@section('titulo')

Informações do Funcionário

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">
	<!-- page content -->
	<div class="right_col" role="main">
		<div class=""> </div>
		<div class="clearfix"></div>
		<div class="row">
<!-- data-target="#delete-modal" -->
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel modal-content">
					<div class="x_content">
						<div class="panel-body">   

							<table class="informacoes_fruncionario">
								<tr>	<td>					</td> <td> 	{{$funcionario->setor->secretaria->nome}} </td>	</tr>
								<tr> 	<td> 	Nome 			</td> <td>	{{$funcionario->nome}} 			</td> </tr>
								<tr> 	<td>	Email			</td>	<td> 	{{$funcionario->user->email}} </td> </tr>
								<tr>	<td> 	CPF			</td>	<td>	{{$funcionario->cpf}} 			</td>	</tr>
								<tr>	<td> 	Matrícula 	</td>	<td>	{{$funcionario->matricula}} 	</td>	</tr>
								<tr>	<td> 	Cargo			</td>	<td>	{{$funcionario->cargo}}			</td>	</tr>
								<tr>	<td> 	Setor			</td>	<td>	{{$funcionario->setor->nome}}	</td>	</tr>
								<tr>	<td> 	Acesso		</td>	<td>	{{$funcionario->role->acesso}}</td>	</tr>
							</table>
							
							
							
							<br><br>

							<div class="x_title"> </div>
							
							<br><br>

							<div class="x_title"> </div>

							<!- botoes -> 
							<div class="ln_solid"></div>
							
							<div class="col-md-1 col-md-offset-11">

						  		<a href="{{ url('/funcionario') }}" 
						  			class="btn btn-primary" 
						  			data-toggle="tooltip" 
						  			title="Retorna a tela anterior">  
						  			Voltar     
					  			</a>
							</div>
							<!- fim botoes ->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- page content -->



@endsection

@push('scripts')

	<script type="text/javascript">
	$('[data-toggle="modal"][title]').tooltip();

	$(document).ready(function(){

	    $(".tip-top").tooltip({placement : 'top'});
	    $(".tip-right").tooltip({placement : 'right'});
	    $(".tip-bottom").tooltip({placement : 'bottom'});
	    $(".tip-left").tooltip({ placement : 'left'});

	    // Link para excluir o usuário
/*	    $("a.botao_deletar").click(function(e){

	    		e.preventDefault();

	    		$("form.form-excluir").submit();
	    });
*/

	    $("#deleta").click(function(e){ 
	    	e.preventDefault();
			swal({
				title: 'Deseja realmente apagar?',
				text: "{{ $funcionario->co_titulo }} {{ $funcionario->no_funcionario }} - Nº {{  $funcionario->nu_funcionario }} ",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim, apague!',
				cancelButtonText: 'Não, cancele!',
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-danger',
				buttonsStyling: false
			}).then(function () {
				swal({title:'Apagada!',text: 'funcionario apagada!!!',type:'success',})
				$("form.form-excluir").submit();
			  	
			})
		});
	});

	</script>

@endpush