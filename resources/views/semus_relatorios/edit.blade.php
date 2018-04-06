@extends('layouts.material')

@section('titulo')

Editar Relatorio {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

<div class="card">
	
	<div class="card-header card-header-icon" data-background-color="dourado">
		<i class="material-icons">chat bubble</i>
	</div>

	<div class="card-content">
		<h4 class="card-title">Editar Relatorio</h4>
		<form action="{{ url("semus/$relatorio->id") }}" method="POST" id="form_relatorio">
			{!! method_field('PUT') !!}
				{{ csrf_field() }}
  

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="input-group" >
					<span class="input-group-addon">
						<i class="material-icons">warning</i>
					</span>

					<div class="form-group label-floating has-roxo is-empty">
						<label class="control-label">Selecione a prioridade do serviço</label>
						<select name="prioridade" id=prioridade class="form-control form-control error">
							@foreach($prioridades as $prioridade)
								@if($prioridade == $relatorio->prioridade)
									<option value="{{$prioridade}}" selected>{{$prioridade}}</option>
								@else	
									<option value="{{$prioridade}}"> {{$prioridade}} </option>
								@endif    
							@endforeach
						</select>
						<span class="material-input"></span>
					</div>
				</div>
			</div>

		 <div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="input-group" >
					<span class="input-group-addon">
						<i class="material-icons">add_location</i>
					</span>

					<div class="form-group label-floating has-roxo is-empty">
						<label class="control-label">Selecione a unidade de atendimento</label>
						<select name="unidade" id=unidade class="form-control form-control error">
							
							@foreach($unidades as $unidade)
								@if($unidade == $relatorio->$unidade)
									<option value="{{$unidade}}" selected>{{$unidade}}</option>
								@else
									<option value="{{$unidade}}"> {{$unidade}} </option>    
								@endif
							@endforeach

						</select>
						<span class="material-input"></span>
					</div>
				</div>
			</div>
			 



		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="input-group">
					<span class="input-group-addon" style="padding-left: 27px">
						<i class="material-icons">event</i>
					</span>
					<div class="form-group label-floating has-roxo is-empty" >
						<label class="label-control" style="color: #3d276b;">Data	</label>
						<input id="data" name="data" type="date" class="form-control" value="{{ $relatorio->data or old('data')}}">
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
						<input name="hora" type="time" class="form-control" value="{{ $relatorio->hora or old('hora')}}">
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
							<i class="material-icons">group</i>
						</span>
						<div class="form-group label-floating has-roxo is-empty">
							<label class="control-label">Responsavel</label>
							<textarea id="responsavel" name="responsavel" type="text" class="form-control"  rows="2">{{$relatorio->responsavel or old('responsavel')}}</textarea>
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
							<textarea id="relato" name="relato" type="text" class="form-control"  rows="2">{{$relatorio->relato or old('relato')}}</textarea>
			
							<span class="material-input"></span>
						</div>
					</div>
				</div>
			</div>
		<!-- ============================FIM DA AREA DE TEXTO============================ -->
			

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
		//Fazer o label do input,select e textarea subir quando estiver preenchido
		$("input, select, textarea").change();
		// Mascara
		VMasker ($("#cep")).maskPattern("99999-999");
      });
		 

	$(document).ready();
	


	$('.clonador').click(function(){
	    $clone = $('.box_funcionario.hide').clone(true);
	    $clone.removeClass('hide');
	    $('#funcionario').append($clone);
	});

	$('.btn_remove').click(function(){
	    $(this).parents('.box_funcionario').remove();
	});

	</script>

@endpush
   