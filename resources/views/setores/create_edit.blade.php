@extends("layouts.material")

@section('titulo')

	@if( isset($setor))
		Alteração de Setor
	@else
		Cadastro de Setor
	@endif

@endsection

@section('content')

<div class="col-md-12 col-md-offset-0">

	<div class="card card-singup">



		@if( isset($setor))

			<form class="form-horizontal" id="form_edit_setor" method="post" action="{{ url("setor/$setor->id") }}"
			style="padding-bottom: 60px;">

			{!! method_field('PUT') !!}

		@else
			<form class="form-horizontal" id="form_edit_setor" method="post" action="{{ url("setor") }}"
			style="padding-bottom: 60px;">
		@endif

		
			{{ csrf_field() }}

			
			<!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">folder_shared</i>
			</div>

			<!-- Título  -->
			<div class="card-content">

				@if( isset($setor))
					<h4 class="card-title no-padding">Alterar cadastro</h4>
				@else
					<h4 class="card-title no-padding">Novo Setor</h4>
				@endif

			</div>			

			<div class="row" style="padding-bottom: 20px;">
				<div class="col-md-12">
					<div class="col-md-12">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">account_balance</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Secretaria</label>
								<select name="secretaria_id" id="select_secretaria" class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7" >

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
				</div>
			</div>
			
			<div class="row" style="padding-bottom: 20px;">
				<div class="col-md-12">
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">folder_shared</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Setor</label>
								<input name="nome" id="nome" type="text" class="form-control error"
								value=" {{ $setor->nome or old('nome') }} ">
							</div>
						</div>
					</div>

					<div class="col-md-2">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">palette</i>
							</span>

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Cor</label>
								<input name="cor" id="cor" type="text" class="form-control error"
								value=" {{ $setor->cor or old('cor') }} " >
							</div>
						</div>
					</div>

					<div class="col-md-2">
						<div class="input-group">

							<div class="form-group label-floating has-dourado">
								<label class="control-label">Icone</label>
								<div id="div_icone"  style="background-color: #ccc; color: white; padding: 25px; border-radius: 5%;"></div>
								<input id="icone" name="icone" type="hidden" class="form-control error" value=" {{ $setor->icone or old('icone') }} ">
							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="row" style="padding-bottom: 20px;">
				<div class="col-md-12">
					<div class="col-md-12">
						<div class="input-group col-md-8 col-md-offset-2">
						
							<div class="form-group label-floating has-dourado">
								{{-- <label class="control-label">Ícone</label> --}}

								
								<div class="material-datatables">
									<table id="datatable_icone" class="table table-striped  table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
												<th> Nome  </th>
												<th> Ícone </th>
												<th class="disabled-sorting text-right">Usar</th>
											</tr>
										</thead>
										{{-- preenchido com datatables --}} 
									</table>
								</div> {{-- Fim Material-datatbles --}}

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
	// Variáveis que guardam as referências para as tablas com o propósito de autalizá-las programaticamente
   let tabelas = [];

	$(function(){
		{{-- Testar se há algum erro, e mostrar a notificação --}}
		@if ($errors->any())
			@foreach ($errors->all() as $error)
				setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
				tempo += incremento;
			@endforeach
		@endif

		$('#cor').colorpicker();

		// Evitar que o ícone seja modificado ao apertar enter

		$("#cor").keypress(function(e){
			//console.log("Apertou uma tecla", e.which)
			if(e.which == 13){
				//console.log("Era a tecla enter");
				e.preventDefault();
			}
		});

		// Atualizar a cor do ícone em tempo real

		$("input#cor").change(function(){ 

			$("#div_icone").css("background-color", $(this).val())

		});

		tabelas.push($("#datatable_icone").DataTable({
	      responsive : true,
	      processing: true,
	      serverSide: true,
	      ajax      : "{{ url('/icone/dados_datatable') }}",
	      columns   : [

	         { data : 'classe',      name : 'classe' },
	         { data : 'nome',     	name : 'nome' },
	         { data : 'acoes',       name : 'acoes' },
	      ],

	      order: [[ 1, 'asc' ]],
	      
	      language : 
	      {
	         "url":         "{{ asset('js/portugues.json') }}",
	         "decimal":     ",",
	         "thousands":   "."
	      }, 

	      stateSave: true,
	      stateDuration: -1,
	      columnDefs: 
	      [
	         { className:   "text-left", 	"targets": [0] },
	         { className:   "text-center", "targets": [1] },
	         { className:   "text-center", "targets": [2] },

	         { width:       "10%",         "targets": [2] },

	      ],
      }));
	});




	$("table#datatable_icone").on("click", ".btn_usar_icone",function(e){
		e.stopPropagation();
		e.preventDefault();

		let id_icone 	= $(this).data('icone');
		let btn 			= $(this);

		

		$("#div_icone").html('<i style="font-size: 30px;" class="mdi ' + $(this).data('icone') +'"></i>');
		$("#div_icone").css("background-color",$("#cor").val());

		// setar o value do input hidden só com a classe do icone
		$("#icone").val($(this).data('icone'));

		console.log($("#icone").val());

   });

	if($("#icone").val()){
		$("#div_icone").html('<i style="font-size: 30px;" class="mdi ' + $("#icone").val() +'"></i>');
		$("#div_icone").css("background-color",$("#cor").val());
	}


	$("#btn_cancelar").click(function(){
		event.preventDefault();
		console.log('canceloou');
		window.location.href = url_base + "/setor";
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
			$("#form_edit_setor").submit();
		/*         swal(
		            'Cadastro alterado!',
		            '',
		            'success'
		            );*/
		         });
	});


</script>

@endpush
