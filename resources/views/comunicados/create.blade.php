@extends('layouts.material')

@section('titulo')

	Novo Comunicado {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="card">
	
	<div class="card-header card-header-icon" data-background-color="dourado">
		<i class="material-icons">chat bubble</i>
	</div>

	<div class="card-content">
		<h4 class="card-title">Novo Comunicado</h4>
		<form action="{{ url('/comunicado') }}" method="POST" id="form_comentario">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6">
					<div class="fileinput fileinput-new " data-provides="fileinput">
						<div class="fileinput-new thumbnail" style="max-width: none">
							<img src="{{asset("img/image_placeholder.jpg")}}" alt="..." id="imagem_thumb">
						</div>

						<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: none"></div>

						<div class="col-md-offset-4 col-sm-offset-4 col-md-12 col-sm-12">
							<span class="btn btn-primary btn-round btn-file">
								<span class="fileinput-new">Selecione</span>
								<span class="fileinput-exists">Alterar</span>
								<input type="file" name="imagem_automatica">
							</span>
							<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class=></i> Excluir</a>
						</div>

						{{-- Imagem do Comunicado --}}
						<input type="hidden" name="imagem" id="imagem"/>

						{{-- ID do Usuário logado --}}
						<input type="hidden" name="funcionario_id" value="{{ $funcionario_logado->id }}">
					</div>
				</div>
			</div>

			<div class="row ">
				<div class="form-group label-floating is-empty col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6" style="margin-left: 25%;">
					<label class="control-label" style="color:#000;">Título</label>
					<input type="text" class="form-control" name="titulo" value="{{ $comunicado->titulo or old('titulo') }}">
					<span class="material-input"></span>
				</div>

				<div class="form-group label-floating is-empty col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6" style="margin-left: 25%;">
					<label class="control-label" style="color:#000;">Subtítulo</label>
					<input type="text" class="form-control" name="subtitulo" value="{{ $comunicado->subtitulo or old('subtitulo') }}">
					<span class="material-input"></span>
				</div>
		                                                
				<div id="div_escrever_comunicado" class="input-group col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6">
					<div class="form-group label-floating is-empty" style="margin-left: 3%;">
						<label class="control-label" style="color:#000;">Comunicado</label>
						<textarea data-solicitacao="" data-funcionario="" id="comunicado" name="texto" class="form-control " placeholder="" style="margin-top: 0px;padding-bottom: 0px;padding-top: 0px;">
							{{ $comunicado->texto or old('texto') }}
						</textarea>
						<span class="material-input"></span>
					</div>

					<div>
						<div class="footer text-center">
							<button type="submit" id="enviar-comunicado" class="botoes-acao btn btn-round btn-success enviar-comunicado">
							<span class="icone-botoes-acao mdi mdi-send"></span>
							<span class="texto-botoes-acao"> ENVIAR </span>
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
			</div>
		</form>
	</div>
</div>

@endsection

@push('scripts')

	<script type="text/javascript">
		
		$(function(){
			// Erros de validação
			@if(count($errors) > 0)
				@foreach($errors->all() as $error)
					$.notify({
						icon : 'notifications',
						message: "{{ $error }}",
					},{
						type: "danger",
						timer: 3000,
						placement: {
							from  : 'top',
							align : 'right'
						}
					});
				@endforeach
			@endif

			$("#btn_cancelar").click(function(){
				event.preventDefault();
				window.location.href = url_base + "/comunicado";
			});

			// Código executado antes que o formulário seja enviado para o Laravel
			$("#form_comentario").submit(function(e) {

				// Verificar se o elemento .fileinput-preview > img já existe, o que indica que o usuário já escolhei uma imagem
				if($(".fileinput-preview img").length > 0)
				{
					// Setar o campo hidden #imagem com o valor da tag <img> que serve de preview do plugin de upload
					$("#imagem").val($(".fileinput-preview img").attr('src'));

					// Enviar o formulário
					return true;

				} else {

					// Notificar o usuário
					$.notify({
						icon : 'notifications',
						message: "Por favor, selecione uma imagem para ser incluída no comunicado.",
					},{
						type: "danger",
						timer: 3000,
						placement: {
							from  : 'top',
							align : 'right'
						}
					});

					// Impedir que o formulário seja enviado pois a imagem ainda não foi selecionada

					e.preventDefault();

					return false;

				}

			});

		});

	</script>

@endpush