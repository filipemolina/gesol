@extends("layouts.material")

@section('titulo')

Cria Funcionário

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">

	<div class="card card-singup">
		<form class="form-horizontal" id="form_create_funcionario" method="post" action="{{ url("funcionario") }}">
				{!! method_field('POST') !!}
				{{ csrf_field() }}

		
			
			 <!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">person</i>
			</div>

			 <!-- Título  -->
			<div class="card-content">
				<h4 class="card-title no-padding">Criação de Funcionario</h4>
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
								value="{{ old('nome') }}">
							</div>
						</div>

						<div class="input-group">
                  	<span class="input-group-addon">
								<i class="material-icons">email</i>
							</span>
                            
                   	<div class="form-group label-floating has-dourado">
								<label class="control-label">Email</label>
								<input name="email" type="text" name="email" type="email" class="form-control error" 
								value="{{ old('email') }} ">
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
									value=" {{ old('cpf') }} ">
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
									value=" {{ old('matricula') }} ">
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
									value="{{ old('cargo') }}">
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
										<select name="secretaria_id" id="select_secretaria" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7" @if($pode_alterar_secretaria != 1) disabled="true" @endif>

											@foreach($secretarias as $secretaria)
												@if ( $funcionario_logado->setor->secretaria->id == $secretaria->id)
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

									<div @if($funcionario_logado->setor->secretaria->id != $secretaria->id) style="display: none;" @endif id="secretaria_{{ $secretaria->id }}" class="input-group select_setores">
			                  	<span class="input-group-addon">
											<i class="material-icons">account_balance</i>
										</span>

										<div class="control form-group label-floating has-dourado">
											<label class="control-label">Setor:</label>

											<input type="hidden" name="setor_id" value="">
											<select name = "setor_id_{{ $secretaria->id }}" id="{{ $secretaria->id }}" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
													
												<option value=""> Selecione... </option>
												@foreach($secretaria->setores as $setor)
													<option value="{{ $setor->id }}"> {{ $setor->nome }} </option>
												@endforeach

											</select>											
										</div>
									</div>

								@endforeach
							</div>
						</div>
					</div>

					{{-- ROLE --}}
					<div class="col-md-11">
						<div class="row">
							<div class="col-md-4">
								<div class="input-group">
	                     	<span class="input-group-addon">
	                     		<span style="font-size: 24px;" class="mdi mdi-server-security"></span>
									</span>
		                            
	                      	<div class="form-group label-floating has-dourado">
										<label class="control-label">Tipo de acesso ao sistema</label>
										<select name = "role" id="role" class="dourado selectpicker error" data-style="select-with-transition has-dourado" >
													
											<option value=""> Selecione... </option>

											@foreach($roles as $role)
												<option value="{{ $role }}" @if($funcionario_logado->role == $role) selected="true"  @endif >
													{{ $role }}
												</option>
											@endforeach

										</select>	

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				 <!-- foto  -->
				<div class="col-md-3 flt-r no-padding">
					<div class="fileinput fileinput-new text-center" data-provides="fileinput">
             		<div class="fileinput-new thumbnail img-circle">
             			<img src=" {{ asset ('img/placeholder.jpg')  }} " alt="...">
                	</div>
						
						<input name="foto" type="text" value="" style="display:none;" />
	              	<div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                    	<div >
	                    	<span class="btn btn-round btn-dourado btn-file botoes-acao">
		                    	<span class="fileinput-new botoes-acao">		
		                    		<i class="fa fa-times"></i>	ADICIONAR 	
		                    	</span>
		                    	<span class="fileinput-exists botoes-acao ">	
		                    		<i class="fa fa-times"></i>	ALTERAR		
		                    	</span>
		                    	<input name="foto1" type="file" value="  "/>
		                    	
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

		        	<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" >
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
		$(function(){
	      {{-- Testar se há algum erro, e mostrar a notificação --}}
	      @if ($errors->any())
	         @foreach ($errors->all() as $error)
	            setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
	            tempo += incremento;
	         @endforeach
	      @endif
      });


		//para adicionar a foto do funcionario_logado
		$("body").on("change.bs.fileinput", function(e){ 
			//console.log("alterou foto");
			var base64 = $(".fileinput-preview img").attr('src');
			$("input[name=foto]").val(base64);
			//console.log(base64);
	 	});

		//mostra os selects de acordo com a secretaria selecionada no select_secretaria
  		$("#select_secretaria").change(function(){
			let secretaria_id = $(this).val();
			$("div.select_setores").css('display', 'none');
			$("div.select_setores#secretaria_"+secretaria_id).css('display', 'table');
		});

		$("#btn_cancelar").click(function(){
	      event.preventDefault();
	       window.history.back();
      });

		$("#btn_salvar").click(function(){
	      event.preventDefault();

	      swal({
	         title: 'Confirma Criação?',
	         type: 'question',
	         showCancelButton: true,
	         confirmButtonColor: '#3085d6',
	         cancelButtonColor: '#d33',
	         confirmButtonText: 'Sim',
	         cancelButtonText: 'Não',
	      }).then(function () {
	      		$("#form_create_funcionario").submit();
		         swal(
		            'Cadastro alterado!',
		            '',
		            'success'
		            );
            });
      })
      
	</script>

@endpush
