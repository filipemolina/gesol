@extends("layouts.material")

@section('titulo')

	@if( isset($servico))
		Alteração de Serviço
	@else
		Cadastro de Serviço
	@endif

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">

	<div class="card card-singup">



		@if(isset($servico))

			<form class="form-horizontal" id="form_edit_servico" method="post" action="{{ url("servico/$servico->id") }}"
			style="padding-bottom: 60px;">

			{!! method_field('PUT') !!}

		@else
			<form class="form-horizontal" id="form_edit_servico" method="post" action="{{ url("servico") }}"
			style="padding-bottom: 60px;">
		@endif

		
			{{ csrf_field() }}

			
			<!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">folder_shared</i>
			</div>

			<!-- Título  -->
			<div class="card-content">

				@if( isset($servico))
					<h4 class="card-title no-padding">Alterar cadastro</h4>
				@else
					<h4 class="card-title no-padding">Novo Serviço</h4>
				@endif

			</div>			

			<div class="row" style="padding-bottom: 20px;">
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">account_balance</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Secretaria</label>
								<select name="secretaria_id" id="select_secretaria" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7" >
									
									@if( isset($servico))
										{{-- EDIÇÃO --}}
									
										@foreach($secretarias as $secretaria)
											@if ( $servico->setor->secretaria->id == $secretaria->id)
												<option value="{{$secretaria->id}}" selected="selected">{{$secretaria->nome}}</option>
											@else
												<option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>  
											@endif
										@endforeach

									@else

										{{-- CRIAÇÃO --}}
										@foreach($secretarias as $secretaria)
											@if ( $funcionario_logado->setor->secretaria->id == $secretaria->id)
												<option value="{{$secretaria->id}}" selected="selected">{{$secretaria->nome}}</option>
											@else
												<option value="{{$secretaria->id}}">{{$secretaria->nome}}</option>  
											@endif
										@endforeach
									@endif
									
									

								</select>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">folder_shared</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Setor</label>
								<select name="setor_id" id="setor_id" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7" >

									@if( isset($servico))
										{{-- EDIÇÃO --}}
									
	 									@foreach($setores as $setor)
											@if ( $servico->setor->id == $setor->id)
												<option value="{{$setor->id}}" selected="selected">{{$setor->nome}}</option>
											@else
												<option value="{{$setor->id}}">{{$setor->nome}}</option>  
											@endif
										@endforeach 

									@else

										{{-- CRIAÇÃO --}}
	{{-- 									@foreach($setores as $setor)
											@if ( $funcionario_logado->setor->id == $setor->id)
												<option value="{{$setor->id}}" selected="selected">{{$setor->nome}}</option>
											@else
												<option value="{{$setor->id}}">{{$setor->nome}}</option>  
											@endif
										@endforeach --}}
									@endif
									
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="padding-bottom: 20px;">
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">build</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Servico</label>
								<input name="nome" id="nome" type="text" class="form-control error"
								value="{{ $servico->nome or old('servico') }}">
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">date_range</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Prazo atendimento</label>
								<input id="prazo" name="prazo" type="number" class="form-control error" 
								value="{{ $servico->prazo or old('prazo') }}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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


@endsection

@push('scripts')

<script type="text/javascript">

	@if( isset($servico))
		{{-- EDIÇÃO --}}
		carrega_select_secretaria_create_servico({{ $servico->setor->secretaria->id }}, {{ $servico->setor->id }});
	@else
		{{-- CRIAÇÃO --}}
		carrega_select_secretaria_create_servico({{ $funcionario_logado->setor->secretaria_id }}, {{ $funcionario_logado->setor_id }});
	@endif


	// if($("#select_setor").val() == null){
	// 	//mostra os selects de acordo com a secretaria selecionada no select_secretaria
	// 	carrega_select_secretaria_create_servico({{ $funcionario_logado->setor->secretaria_id }}, {{ $funcionario_logado->setor_id }});
	// 	console.log("entrou if");
	// };


	$(function(){
	

		{{-- Testar se há algum erro, e mostrar a notificação --}}
		@if ($errors->any())
			@foreach ($errors->all() as $error)
				setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
				tempo += incremento;
			@endforeach
		@endif


    	//mostra os selects de acordo com a secretaria selecionada no select_secretaria
  		$("#select_secretaria").change(function(){
			let secretaria_id = $(this).val();
         //AJAX PEGAR OS SETORES
       	carrega_select_secretaria_create_servico(secretaria_id, {{ $funcionario_logado->setor_id }});
       	console.log("mudiou?");
		});

		$("#btn_cancelar").click(function(){
			event.preventDefault();
			//console.log('canceloou');
			window.location.href = url_base + "/servico";
		});

		$("#btn_salvar").click(function(){
			event.preventDefault();

			swal({
				title: 'Confirma @if(isset($servico)) "Alteração" @else Cadastro @endif ?',
				type: 'question',
				text: "Essa alteração será refletida no \"Mesquita 360\"!",
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sim',
				cancelButtonText: 'Não',
			}).then(function () {
				$("#form_edit_servico").submit();
	    	});
		});
	});


	// Carrega select de secretaria na página de criação/edição de serviço
	function carrega_select_secretaria_create_servico(secretaria_id, setor_id){

	  $.get(url_base+'/setoresDaSecretaria?secretaria='+secretaria_id, function(res){

		//console.log(res);
		let resposta = JSON.parse(res);
		//console.log(resposta);     

		$("#setor_id option").remove();

		$("<option value=''>Selecione</option>").appendTo("#setor_id");

		// Iterar por todos os setores para incluí-los no supra-citado "select"
		for(i=0; i<resposta.length; i++){

			console.log(resposta[i].nome);

			@if( isset($servico))
				{{-- EDIÇÃO --}}
				if( '{{ $servico->setor->nome}}' == resposta[i].nome ){
					$("<option value='"+resposta[i].id+"' selected>"+resposta[i].nome+"</option>").appendTo("#setor_id");
					var valor_banco = resposta[i].id;
				}else{
					$("<option value='"+resposta[i].id+"'>"+resposta[i].nome+"</option>").appendTo("#setor_id");
				};
			@else
				{{-- CRIAÇÃO --}}
				$("<option value='"+resposta[i].id+"'>"+resposta[i].nome+"</option>").appendTo("#setor_id");
			@endif
			
		}

		// Atualizar o Bootstrap Select
		$("#setor_id").selectpicker('refresh');

	});
}

</script>

@endpush
