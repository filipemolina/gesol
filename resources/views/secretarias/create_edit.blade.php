@extends("layouts.material")

@section('titulo')

	@if( isset($secretaria))
		Alteração de Secretaria
	@else
		Cadastro de Secretaria
	@endif

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">

	<div class="card card-singup">



		@if( isset($secretaria))

			<form class="form-horizontal" id="form_edit_secretaria" method="post" action="{{ url("secretaria/$secretaria->id") }}"
			style="padding-bottom: 60px;">

			{!! method_field('PUT') !!}

		@else
			<form class="form-horizontal" id="form_edit_secretaria" method="post" action="{{ url("secretaria") }}"
			style="padding-bottom: 60px;">
		@endif

		
			{{ csrf_field() }}

			
			<!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">account_balance</i>
			</div>

			<!-- Título  -->
			<div class="card-content">

				@if( isset($secretaria))
					<h4 class="card-title no-padding">Alterar cadastro</h4>
				@else
					<h4 class="card-title no-padding">Nova Secretaria</h4>
				@endif

			</div>			
			
			<div class="row" style="padding-bottom: 20px;">
				<div class="col-md-12">
					<div class="col-md-9">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">account_balance</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Secretaria</label>
								<input name="nome" id="nome" type="text" class="form-control error"
								value="{{ $secretaria->nome or old('nome') }}">
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">star_half</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Sigla</label>
								<input id="sigla" name="sigla" type="text" class="form-control error text-uppercase" 
								value="{{ $secretaria->sigla or old('sigla') }}">
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
								<i class="material-icons">person</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Secretário</label>
								<input name="secretario" id="secretario" type="text" class="form-control error"
								value="{{ $secretaria->secretario or old('secretario') }}">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group">
                  	<span class="input-group-addon">
								<i class="material-icons">email</i>
							</span>
                            
                   	<div class="form-group label-floating has-dourado">
								<label class="control-label">Email</label>
								<input name="email" type="text" name="email" type="email" class="form-control error" 
								value="{{ $secretaria->email or  old('email') }}">
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
								<i class="material-icons">timer</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Inicio Atendimento</label>
								<input name="inicio_atendimento" id="inicio_atendimento" type="text" class="form-control error datetimepicker"
								value="{{ $secretaria->inicio_atendimento or old('inicio_atendimento') }}">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group">
                  	<span class="input-group-addon">
								<i class="material-icons">timer_off</i>
							</span>
                            
                   	<div class="form-group label-floating has-dourado">
								<label class="control-label">Término Atendimento</label>
								<input name="termino_atendimento" type="text" name="termino_atendimento" type="termino_atendimento" class="form-control error datetimepicker" 
								value="{{ $secretaria->termino_atendimento or  old('termino_atendimento') }}">
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

	$(function(){


		{{-- Testar se há algum erro, e mostrar a notificação --}}
		@if ($errors->any())
		@foreach ($errors->all() as $error)
		setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
		tempo += incremento;
		@endforeach
		@endif
	});


	$('.datetimepicker').datetimepicker({
    	format: 'LT'
 	});


	$("#btn_cancelar").click(function(){
		event.preventDefault();
		console.log('canceloou');
		window.location.href = url_base + "/secretaria";
	});

	$("#btn_salvar").click(function(){
		event.preventDefault();

		swal({
			title: 'Confirma alteração?',
			type: 'question',
			text: "Essa alteração será refletida no \"Mesquita 360\"!",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sim',
			cancelButtonText: 'Não',
		}).then(function () {
			$("#form_edit_secretaria").submit();
		/*         swal(
		            'Cadastro alterado!',
		            '',
		            'success'
		            );*/
		         });
	});


</script>

@endpush
