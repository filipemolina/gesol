@extends("layouts.material")

@section('titulo')

Alteração de funcionário 

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">

	<div class="card card-esquerdo card-singup">
		<form class="form-horizontal" id="form_edit_funcionario" method="post" action="{{ url("funcionario/$funcionario->id") }}">
				{!! method_field('PUT') !!}
				{{ csrf_field() }}
	
			<!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">person</i>
			</div>

			<!-- Título  -->
			<div class="card-content">
				<h4 class="card-title ">Alteração de Funcionario</h4>
			</div>			
			
			<div class="row">
				<div class="col-md-9">
					<div class="input-group ">
						<span class="input-group-addon ">
							<i class="material-icons">face</i>
						</span>

						<div class="form-group label-floating has-dourado is-empty">
							<label class="control-label">Nome</label>
							<input name="nome" type="text" class="form-control error" 
							value="{{ $funcionario->nome or old('nome') }}">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-9">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">email</i>
						</span>
								
						<div class="form-group label-floating has-dourado is-empty">
							<label class="control-label">Email</label>
							<input name="email" type="email" class="form-control error" 
							value="{{ $funcionario->user->email or old('email') }} ">
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">credit_card</i>
						</span>
						<div class="form-group label-floating has-dourado is-empty">
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
						<div class="form-group label-floating has-dourado is-empty">
							<label class="control-label">Matrícula</label>
							<input id="matricula" name="matricula" type="text" class="form-control error" 
							value=" {{ $funcionario->matricula or old('matricula') }} ">
						</div>
					</div>
				</div>
								
				<div class="col-md-2">
					<div class="input-group ">
						<span class="input-group-addon">
							<span style="font-size: 24px;" class="mdi mdi-city"></span>
						</span>
						<div class="form-group label-floating has-dourado">
							<label class="control-label">Tipo</label>
							<select name = "tipo" id="tipo" class="dourado selectpicker error" data-style="select-with-transition has-dourado" >
								<option value=""> Selecione... </option>
								@foreach($tipos as $tipo)
									@if ( $funcionario->tipo == $tipo)
										<option value="{{ $tipo }}" selected="selected">{{ $tipo }}</option>
									@else
										<option value="{{ $tipo }}">{{ $tipo }}</option>
									@endif
								@endforeach
							</select>	
						</div>
					</div>
				</div>
			</div>
				
			<div class="row">
				<div class="col-md-6">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">account_balance</i>
						</span>
						<div class="control form-group label-floating has-dourado">
							<label class="control-label">Secretaria</label>
							<select name="select_secretaria" id="select_secretaria" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7" @if($pode_alterar_secretaria != 1) disabled="true" @endif>
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

				<div class="col-md-5">
					<div  class="input-group ">
						<span class="input-group-addon ">
							<span style="font-size: 26px;" class="mdi mdi-folder-account"></span>
						</span>
						<div class="control form-group label-floating has-dourado">
							<label class="control-label">Cargo:</label>
							<select name = "cargo_id" id="cargo_id" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
									<option value=""> Selecione... </option>
							</select>											
						</div>
					</div>
				</div>
						
				<div class="col-md-6">
					<div @if($funcionario_logado->setor->secretaria->id != $secretaria->id) @endif id="secretaria_id" class="input-group select_setores">
						<span class="input-group-addon">
							<i class="material-icons">account_balance</i>
						</span>
						<div class="control form-group label-floating has-dourado">
							<label class="control-label">Setor:</label>
							<select name = "setor_id" id="setor_id" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
									<option value=""> Selecione... </option>
							</select>											
						</div>
					</div>
				</div>
				
				<div class="col-md-5">
					<div class="input-group">
						<span class="input-group-addon">
							<span style="font-size: 24px;" class="mdi mdi-server-security"></span>
						</span>
									
						<div class="form-group label-floating has-dourado">
							<label class="control-label">Tipo de acesso ao sistema</label>
							<select name = "role_id" id="role_id" class="dourado selectpicker error" data-style="select-with-transition has-dourado" >
								<option value=""> Selecione... </option>
								@foreach($roles as $role)
									@if ( $funcionario->role_id == $role->id)
										<option value="{{$role->id}}" selected="selected">{{$role->acesso}}</option>
									@else
										<option value="{{$role->id}}">{{$role->acesso}}</option>  
									@endif
								@endforeach
							</select>	
						</div>
					</div>
				</div>
				
				{{--  ==============================================================  --}}

				<div class="col-md-11">
					<div class="input-group">
						<span class="input-group-addon">
							<span style="font-size: 24px;" class="mdi mdi-server-security"></span>
						</span>
									
						<div class="form-group label-floating has-dourado col-md-11">
							<label class="control-label">Atribuições de sistema</label>
								<select  name = "atribuicoes[]" 
									class="selectpicker" 
									multiple
									data-actions-box="true"
									data-style="btn select-with-transition" 
									data-width = "90%"
									title="Selecione..." 
									data-size="7">
									
									<option disabled=""> Selecione as opções</option>
									@foreach($atribuicoes as $atribuicao)
										
										<option @if( in_array($atribuicao->id, $atribuicoes_ids) ) selected @endif value="{{ $atribuicao->id }}"> {{ $atribuicao->descricao }} </option>
									@endforeach
								</select>
						</div>
					</div>
				</div>

				<!-- foto  -->
				<div class="col-md-3 flt-r ">
					<div class="fileinput fileinput-new text-center" data-provides="fileinput">
						<div class="fileinput-new thumbnail img-circle">
							
							@if($funcionario->foto)
								<img src="{{ $funcionario->foto }}"/>
							@elseif(old('foto'))
								<img src="{{ old('foto') }}"/>
							@else
								<img src="{{ asset('img/placeholder.jpg') }}"/>
							@endif
						</div>
						<input name="foto" type="text" value="" style="display:none;" />
						<div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
						
						<div>
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
			</form>

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
		</div>
	</div>
@endsection

@push('scripts')

	<script type="text/javascript">
		
		
		$(function(){
			//Ajusta os labels para cima, para que não fiquem sobrepostos aos valores que estão nos inputs
			$("input, select").change();
			
			// Obter o valor atual do Widget de Foto e setar o valor do input hidden com name="foto"
			
			let foto_base64 = $(".fileinput-new img").attr('src');
			console.log(foto_base64);
			$("input[name=foto]").val(foto_base64);
			
			// Preencher o select de cargos e setores no load da pagina
	    	if($("#select_secretaria").length)
	    	{
	 			//console.log($("#select_secretaria").length);
	        	let secretaria_id = $("#select_secretaria").val();
				
				let setor_id = " {{ $funcionario->setor_id }} ";
				carrega_select_setor_edit(secretaria_id, setor_id);
		  
				let cargo_id = "{{$funcionario->cargo_id}}";
	        	carrega_select_cargo_edit(secretaria_id, cargo_id);
		        
	     		$(".previnir").click(function() {
	            event.preventDefault();
	        	});
	    	}

			
	      {{-- Testar se há algum erro, e mostrar a notificação --}}
	      @if ($errors->any())
				@foreach ($errors->all() as $error)
					setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
					tempo += incremento;
				@endforeach
	      @endif
			
			
			//p Evento é disparado toda vez que o Widget de foto for modificado
			
			$(".file-upload").on("change.bs.fileinput", function(e){ 
				var base64 = $(".fileinput-preview img").attr('src');
				$("input[name=foto]").val(base64);
			});
			
			//mostra os selects de acordo com a secretaria selecionada no select_secretaria
	  		$("#select_secretaria").change(function(){
				  let secretaria_id = $(this).val();
				  
				//AJAX PEGAR OS CARGOS
				carrega_select_cargo_edit(secretaria_id, {{ $funcionario->cargo_id }});

				//AJAX PEGAR OS SETORES
				carrega_select_setor_edit(secretaria_id,  {{ $funcionario->setor_id }});
				

			});

			$("#btn_cancelar").click(function(){
				event.preventDefault();
		      console.log('canceloou');
		      window.location.href = url_base + "/funcionario";
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
					/*         swal(
						'Cadastro alterado!',
		            '',
		            'success'
		            );*/
	            });
				});
				
			});
			
		</script>


			
		@endpush
		