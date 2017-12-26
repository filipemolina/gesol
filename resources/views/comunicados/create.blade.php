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

<div class="row">
	
	<div class="col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6">
		
		<div class="fileinput fileinput-new " data-provides="fileinput">

			<div class="fileinput-new thumbnail" style="max-width: none">
			<img src="{{asset("img/image_placeholder.jpg")}}" alt="...">
			</div>

				<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: none"></div>

			<div class="col-md-offset-4 col-sm-offset-4 col-md-12 col-sm-12">
				<span class="btn btn-primary btn-round btn-file">
					<span class="fileinput-new">Selecione</span>
					<span class="fileinput-exists">Alterar</span>
					<input type="file" name="...">
				</span>
			<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class=></i> Excluir</a>
			</div>
		</div>
	</div>

</div>

<div class="row ">
	
	<div class="form-group label-floating is-empty col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6" style="margin-left: 25%;">
		<label class="control-label" style="color:#000;">Título</label>
			<input type="text" class="form-control">
				<span class="material-input"></span>
	</div>

	<div class="form-group label-floating is-empty col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6" style="margin-left: 25%;">
		<label class="control-label" style="color:#000;">Subtítulo</label>
			<input type="text" class="form-control">
				<span class="material-input"></span>
	</div>
                                                
		<div id="div_escrever_comunicado" class="input-group col-md-offset-3 col-sm-offset-3 col-md-6 col-sm-6">
			<div class="form-group label-floating is-empty" style="margin-left: 3%;">
					<label class="control-label" style="color:#000;">Comunicado</label>
						<textarea data-solicitacao="" data-funcionario="" id="comunicado" name="comunicado" class="form-control " placeholder="" style="margin-top: 0px;padding-bottom: 0px;padding-top: 0px;"></textarea>
							<span class="material-input"></span>
			</div>

			<div>
				<span class="input-group-addon">
					<button type="button" id="enviar-comunicado" data-solicitacao="" data-funcionario="" class="btn btn-primary btn-round enviar-comunicado">
					Enviar
					</button>
				</span>

			</div>
		</div>

		</div>
	</div>
</div>

@endsection