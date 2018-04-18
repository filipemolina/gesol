@extends('layouts.material')

@section('titulo')

Novo Relatorio {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="card">
	
	<div class="card-header card-header-icon" data-background-color="dourado">
		<i class="material-icons">chat bubble</i>
	</div>

	<div class="card-content">
		<h4 class="card-title">Novo Relatorio</h4>
		<form action="{{ url('/semus ') }}" method="POST" id="form_relatorio">
			{{ csrf_field() }}

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="input-group">
					<span class="input-group-addon" style="padding-left: 27px">
						<i class="material-icons">event</i>
					</span>
					<div class="form-group label-floating has-roxo is-empty" >
						<label class="label-control" style="color: #3d276b;">Data	</label>
						<input id="data" name="data" type="date" class="form-control" value="">
						<span class="material-input"></span>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4 col-md-offset-3">
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">access_time</i>
					</span>
					<div class="form-group label-floating has-roxo is-empty" style="padding-right: 84px">
						<label class="label-control" style="color: #3d276b;">Hora	</label>
						<input name="hora" type="time" class="form-control">
						<span class="material-input"></span>
					</div>
				</div>
			</div>
		</div>
		

		<!-- ============================AREA DE TEXTO============================ -->
			<div class="row">
				<div class="card-content">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">insert_comment</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Relato Sucinto</label>
							<textarea id="relato" name="relato" type="text" class="form-control"  rows="2"></textarea>
			
							<span class="material-input"></span>
						</div>
					</div>
				</div>
			</div>
		<!-- ============================FIM DA AREA DE TEXTO============================ -->

		
			<!-- ============================IMAGEM============================ -->
			
			 <div >
			 	<div id="imagens">
					<div>
						<div class="small-12 columns text-right">
    		 				<center>
    		 					<h4>ADICIONAR FOTOS AO FORMULARIO</h4>
    		 					<button type="button" class="small tiny alert clonarfoto btnfuncionario"></button>
    		 				</center>
 						</div>
						<div class="fileinput fileinput-new box_imagens hide" data-provides="fileinput">
							<div class="fileinput-new thumbnail" style="max-width: 285px;">
								<img src="{{asset("img/image_placeholder.jpg")}}" alt="..." id="imagem_thumb">
							</div>

							<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 285px;"></div>

							<div class="col-md-offset-4 col-sm-offset-4 col-md-12 col-sm-12">
								<span class="btn btn-primary btn-round btn-file">
									<span class="fileinput-new">Selecione</span>
									<span class="fileinput-exists">Alterar</span>
									<input type="file" name="foto">
								</span>
								<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class=></i>Excluir</a>
							</div>

							<input type="hidden" name="fotos[]" class="foto"/>
							<input type="hidden" name="imagens[]" class="imagens"/>
							<div class="col-xs-12 col-md-2">
							<div class="input-group">
        						<input type="button" class="button tiny success btn_remove" value="Remover"  />
    						</div>
    					</div>

						</div>
					</div>
				</div>	
			</div>  
			<!-- ============================FIM IMAGEM============================ -->
			

			<!-- ============================BOTOES============================ -->
			<div class="row col-md-12 col-sm-12">
				<div>
					<div class="footer text-center">
						<button type="submit" id="enviar-relatorio" class="botoes-acao btn btn-round btn-success enviar-relatorio">
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
			<!-- ============================FIM BOTOES============================ -->
	
		</form>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
		$(function(){

			$('body').on('change.bs.fileinput', function(e){

				// Executar apenas se o evento for disparado pelo plugin de imagens

				if($(e.target).is("div.fileinput.box_imagens"))
				{
					let base64 = $(e.target).find(".fileinput-preview img").attr('src');

					let input = $(e.target).find("input.imagens").first();

					$(input).val(base64);
				}

			});

			$('body').on('clear.bs.fileinput', function(e){

				let base64 = $(e.target).find(".fileinput-preview img").attr('src');

				let input = $(e.target).find("input.imagens").first();

				$(input).val(base64);

			});

			$('.clonarfoto').click(function(){
			    $clone = $('.box_imagens.hide').clone(true);
			    $clone.removeClass('hide');
			    $('#imagens').append($clone);
			});

			$('.btn_remove').click(function(){
			    $(this).parents('.box_imagens').remove();
			});

			$("#btn_cancelar").click(function(){
		      event.preventDefault();
		       window.history.back();
	      });

      	});
	</script>
@endpush
   