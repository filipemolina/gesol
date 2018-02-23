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
		<form action="{{ url('/relatorio') }}" method="POST" id="form_relatorio">
			{{ csrf_field() }}


		<!-- ============================CHECKBOX============================ -->
		
			<div class="row col-md-offset-2 col-sm-offset-2 col-md-12 col-sm-12" >
				<div class="card-content">
					<label style="color: #000; margin-left: 15px">
						<input value="notificacao" name="notificacao" type="checkbox"> Notificação
					</label>
					<label style="color: #000; margin-left: 15px">
						<input value="autuacao" name="autuacao" type="checkbox"> Autuação
					</label>
					<label style="color: #000; margin-left: 15px">
						<input value="multa" name="multa" type="checkbox"> Multa
					</label>
					<label style="color: #000; margin-left: 15px">
						<input value="registro_dp" name="registro_dp" type="checkbox"> Registo em DP
					</label>
					<label style="color: #000; margin-left: 15px">
						<input value="auto_pf" name="auto_pf" type="checkbox"> A.P.F
					</label>
				</div>
			</div>
		<!-- ============================FIM CHECKBOX============================ -->
		
			<div class="row">
				<div class="input-group col-md-12 col-sm-12" >
					<span class="input-group-addon">
						<i class="material-icons">swap_horiz</i>
					</span>

					<div class="form-group label-floating has-roxo is-empty">
						<label class="control-label">Selecione a origem do serviço</label>
						<select nome="origem" id=origem class="form-control form-control error">
							<option value="" selected> </option>
						</select>
						<span class="material-input"></span>
					</div>

					<span class="input-group-addon">
						<i class="material-icons">card_membership</i>
					</span>
					<div class="form-group label-floating has-roxo is-empty">
						<label class="control-label">Selecione a ação desenvolvida</label>
						<select name="envolvidos" id="envolvidos" class="form-control form-control error">
							<option value="">  </option>						
						</select>
						<span class="material-input"></span>
					</div>
				</div>

					<div class="input-group col-md-12 col-sm-12">
						<span class="input-group-addon" style="padding-left: 27px">
							<i class="material-icons">event</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty col-md-offset-4 col-sm-offset-4 col-md-6 col-sm-6" >
							<label class="label-control" style="color: #3d276b;">Data	</label>
							<input name="data" type="date" class="form-control" value="">
							<span class="material-input"></span>
						</div>

						<span class="input-group-addon">
							<i class="material-icons">access_time</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty col-md-offset-4 col-sm-offset-4 col-md-6 col-sm-6" style="padding-right: 84px">
							<label class="label-control" style="color: #3d276b;">Hora	</label>
							<input name="hora" type="time" class="form-control">
							<span class="material-input"></span>
						</div>
					</div>
			</div>
			<!-- ============================lOCAL============================ -->
			<div class="row ">
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">mail_outline</i>
						</span>
							<div class="form-group label-floating has-roxo is-empty">
								<label class="control-label">CEP</label>
								<input id="cep" name="endereco[cep]" type="text" class="form-control error" value="">
								<span class="material-input"></span>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-8">	
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">explore</i>
							</span>
							<div class="form-group label-floating has-roxo is-empty">
								<label class="control-label">Bairro</label>
								<input id="bairro" name="endereco[bairro]" type="text" class="form-control error" value="">
								<span class="material-input"></span>
							</div>
						</div>
					</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-7">
					<div class="input-group">
						<span class="input-group-addon">
								<i class="material-icons">call_split</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Rua</label>
							<input id="rua" name="rua" type="text" class="form-control error" value="">
							
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-2">
					<div class="input-group">	
						<span class="input-group-addon">
								<i class="material-icons">home</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Numero</label>
							<input id="numero" name="endereco[numero]" type="text" class="form-control error" value="">
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3">
					<div class="input-group"> 
						<span class="input-group-addon">
							<i class="material-icons">explore</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Complemento</label>
							<input id="complemento" name="complemento" type="text" class="form-control error" value="">
						</div>
					</div>
					</div>
			</div>
			<!-- ============================FIM LOCAL============================ -->

			<!-- ============================AREA DE TEXTO============================ -->
			<div class="row">
				<div class="card-content">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">group</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Envolvidos</label>
							<input id="envolvidos" name="envolvidos" type="text" class="form-control error" value="">
							<span class="material-input"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="card-content">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">insert_comment</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Relato Sucinto</label>
							<input id="relato" name="relato" type="text" class="form-control error" value="">
							<span class="material-input"></span>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="card-content">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">mode_edit</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Providências Adotadas</label>
							<input id="providencia" name="providencia" type="text" class="form-control error" value="">
							<span class="material-input"></span>
						</div>
					</div>
				</div>
		 	</div>
			<!-- ============================FIM AREA DE TEXTO============================ -->

			<!-- ============================IMAGEM============================ -->
			<center>
				<h3>Imagens</h3>
				<div class="row">
				
				</div>
			</center>
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
			// Mascara
			VMasker ($("#cep")).maskPattern("99999-999");
      });
		 
	</script>

@endpush

