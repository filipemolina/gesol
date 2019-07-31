@extends("layouts.material")

@section('titulo')

Alteraração de senha

@endsection

@section('content')

<div class="col-md-10 col-md-offset-1">

	<div class="card card-singup">
		<form action="{{ url('salvasenha') }}" method="POST" class="form-horizontal" id="form-altera-senha">
			{{ csrf_field() }}

			
			 <!-- Ícone título  -->
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">person</i>
			</div>

			 <!-- Título  -->
			<div class="card-content">
				<h4 class="card-title no-padding">Alterar senha</h4>
			</div>			
			
			<div class="row">
				
				 <!-- Dados  -->
				<div class="col-md-8">
					<div class="card-content no-padding">
						<div class="input-group-prepend">
                  	<span class="input-group-text">
                      	<i class="material-icons">lock_outline</i>
							</span>
							<div> 
							<div class="form-group label-floating has-dourado">
								<label class="control-label">Senha Atual</label>
								<input type="password" name="password_atual" class="form-control error">
							</div>
							</div>
						</div>

						<div class="input-group-prepend">
                  	<span class="input-group-text">
                      	<i class="material-icons">lock_outline</i>
							</span>
							<div> 
							<div class="form-group label-floating has-dourado">
								<label class="control-label">Nova Senha</label>
								<input type="password" name="password" class="form-control error">
							</div>
							</div>
						</div>

                  <div class="input-group-prepend">
                  	<span class="input-group-text">
                      	<i class="material-icons">lock_outline</i>
							</span>
							<div> 
							<div class="form-group label-floating has-dourado">
								<label class="control-label">Confirmar senha</label>
								<input type="password" name="password_confirmation" type="password" class="form-control error" >
							</div>
							</div>
                  </div>
					</div>
				</div>

				
			</div>  <!-- FIM ROW  -->
		</form>

		<div class="footer text-center">
			<button id="btn_salvar" class="botoes-acao btn btn-round btn-success" onclick="enviaForm()">
            <span class="icone-botoes-acao mdi mdi-send"></span>
            <span class="texto-botoes-acao"> Salvar </span>
            <div class="ripple-container"></div>
         </button>
        	<button  id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" onclick="VoltaPagina()">
            <span class="icone-botoes-acao mdi mdi-backburger"></span>   
            <span class="texto-botoes-acao"> Cancelar </span>
            <div class="ripple-container"></div>
         </button>
		</div>

	</div>
</div>
    
@endsection

@push('scripts')

	<script type="text/javascript">
		$(document).ready(function() {
			var tempo = 0;
			var incremento = 500;
			
			// Testar se há algum erro, e mostrar a notificação
			@if ($errors->any())
				@foreach ($errors->all() as $error)
					setTimeout(function(){demo.notificationRight("top", "right", "rose", "{{ $error }}"); }, tempo);
					tempo += incremento;
				@endforeach
			@endif
			demo.initFormExtendedDatetimepickers();
		});

		function enviaForm(){
			document.getElementById("form-altera-senha").submit();
		}

		function VoltaPagina() {
    		window.history.back();
		}

	</script>


@endpush