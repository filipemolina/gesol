@extends("layouts.material")

@section('titulo')

Alterar funcionário

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">

	<div class="card card-singup">
		<form class="form-horizontal" id="form_edit_funcionario" method="post" action="{{ url("funcionario/$funcionario->id") }}">
				{!! method_field('PUT') !!}
				{{ csrf_field() }}

		
			
			 <!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">person</i>
			</div>

			 <!-- Título  -->
			<div class="card-content">
				<h4 class="card-title no-padding">Alterar cadastro</h4>
			</div>			
			
			<div class="row">
				
				 <!-- Dados  -->
				<div class="col-md-9">
					<div class="card-content no-padding">
						<div class="input-group ">
							<span class="input-group-addon ">
								<i class="material-icons">face</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Nome</label>
								<input name="nome" type="text" class="form-control error" 
								value="{{ $funcionario->nome or old('nome') }}">
							</div>
						</div>

						<div class="input-group">
                  	<span class="input-group-addon">
								<i class="material-icons">email</i>
							</span>
                            
                   	<div class="form-group label-floating has-dourado">
								<label class="control-label">Email</label>
								<input name="email" type="text" name="email" type="email" class="form-control error" 
								value="{{ $funcionario->user->email or  old('email') }} ">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-11">
					<div class="row">
						<div class="col-md-3">
							<div class="input-group">
                     	<span class="input-group-addon">
									<i class="material-icons">credit_card</i>
								</span>
	                            
                      	<div class="form-group label-floating has-dourado">
									<label class="control-label">CPF</label>
									<input name="cpf" id="cpf" type="text" class="form-control error"
									value=" {{ $funcionario->cpf or old('cpf') }} ">
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">credit_card</i>
								</span>

								<div class="form-group label-floating has-dourado">
									<label class="control-label">Matrícula</label>
									<input id="matricula" name="matricula" type="text" class="form-control error" 
									value=" {{ $funcionario->matricula or old('matricula') }} ">
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="input-group ">
								<span class="input-group-addon ">
									<span style="font-size: 26px;" class="mdi mdi-folder-account"></span>
								</span>

								<div class="form-group label-floating has-dourado">
									<label class="control-label">Cargo</label>
									<input name="cargo" type="text" class="form-control error" 
									value="{{ $funcionario->cargo or old('cargo') }}">
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-11">
					
						<div class="row">
							<div class="col-md-8">
								<div class="input-group">
		                  	<span class="input-group-addon">
										<i class="material-icons">account_balance</i>
									</span>

									<div class="control form-group label-floating has-dourado">
										<label class="control-label">Secretaria</label>
										<select name="select_secretaria" id="select_secretaria" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
											@foreach($secretarias as $secretaria)
												@if ( $funcionario->setor->secretaria->id == $secretaria->id)
													<option value="{{$secretaria->id}}" selected="selected">{{$secretaria->nome}}</option>
												@else
													<option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>  
												@endif
											@endforeach
										</select>
									</div>
								</div>
							</div>
							
							<div class="col-md-4">

								@foreach($secretarias as $secretaria)

									<div @if($funcionario->setor->secretaria->id != $secretaria->id) style="display: none;" @endif id="secretaria_{{ $secretaria->id }}" class="input-group select_setores">
			                  	<span class="input-group-addon">
											<i class="material-icons">account_balance</i>
										</span>

										<div class="control form-group label-floating has-dourado">
											<label class="control-label">Setor:</label>

											<select name = "setor_id_{{ $secretaria->id }}" id="{{ $secretaria->id }}" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
													
												<option value=""> Selecione... </option>
												@foreach($secretaria->setores as $setor)
													<option value="{{ $setor->id }}" 
														@if($funcionario->setor->id == $setor->id) 
															selected="true" 
														@endif >
														{{ $setor->nome }}
													</option>
												@endforeach

											</select>											
										</div>
									</div>

								@endforeach

							</div>
							
						</div>
					</div>
				</div>

				 <!-- foto  -->
				<div class="col-md-3 flt-r no-padding">
					<div class="fileinput fileinput-new text-center" data-provides="fileinput">
             		<div class="fileinput-new thumbnail img-circle">
                    	<img src=" {{ asset ('img/placeholder.jpg') }} " alt="...">
                	</div>

	              	<div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                    	<div >
	                    	<span class="btn btn-round btn-dourado btn-file botoes-acao">
		                    	<span class="fileinput-new botoes-acao">		
		                    		<i class="fa fa-times"></i>	ADICIONAR 	
		                    	</span>
		                    	<span class="fileinput-exists botoes-acao ">	
		                    		<i class="fa fa-times"></i>	ALTERAR		
		                    	</span>
		                    	<input name="foto" type="file" name="..." value=" {{ $funcionario->user->foto  }} "/>
	                    	</span>
								<br/>
	                    	<span class="btn btn-danger btn-round fileinput-exists botoes-acao" data-dismiss="fileinput">
	                    		<i class="fa fa-times"></i> REMOVER 
	                    	</span>
                    	</div>
						</div>
					</div>
				</div>  <!-- FIM ROW  -->

				<div class="footer text-center">
					<button type="submit" id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
	               <span class="icone-botoes-acao mdi mdi-send"></span>
	               <span class="texto-botoes-acao"> SALVAR </span>
	               <div class="ripple-container"></div>
	            </button>

		        	<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" href="http://gesol.dev/solicitacao">
	               <span class="icone-botoes-acao mdi mdi-backburger"></span>   
	               <span class="texto-botoes-acao"> CANCELAR </span>
	               <div class="ripple-container"></div>
	            </button>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')

	<script type="text/javascript">
		//mostra os selects de acordo com a secretaria selecionada no select_secretaria
  		$("#select_secretaria").change(function(){
			let secretaria_id = $(this).val();
			$("div.select_setores").css('display', 'none');
			$("div.select_setores#secretaria_"+secretaria_id).css('display', 'table');
		});

		$("#btn_salvar").click(function(){
	      event.preventDefault();

	      swal({
	         title: 'Confirma alteração?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
	      	$("#form_edit_funcionario").submit();
	         swal(
	            'Cadastro alterado!',
	            '',
	            'success'
	            );
            });
      })
      
	</script>

@endpush
