@extends("layouts.material")

@section('titulo')

Alterar funcionário

@endsection

@section('content')

<div class="col-md-10 col-md-offset-1">

	<div class="card card-singup">
		<form action="{{ url('/users/alterarsenha') }}" method="POST" class="form-horizontal" id="form-cadastro-usuario">
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
						<div class="input-group">
                  	<span class="input-group-addon">
                      	<i class="material-icons">lock_outline</i>
							</span>
                   	<div class="form-group label-floating has-dourado">
								<label class="control-label">Senha</label>
								<input name="senha" type="password" name="password" class="form-control error" 
								value=" {{ old('senha') }} ">
							</div>
						</div>

                  <div class="input-group">
                  	<span class="input-group-addon">
                      	<i class="material-icons">lock_outline</i>
							</span>
                   	<div class="form-group label-floating has-dourado">
								<label class="control-label">Confirmar senha</label>
								<input name="confirma-senha" type="password" name="password" type="password" class="form-control error" 
								value=" {{ old('confirma-senha') }} ">
							</div>
                  </div>
					</div>
				</div>

				
			</div>  <!-- FIM ROW  -->

			<div class="footer text-center">
				<button id="btn_salvar" class="botoes-acao btn btn-round btn-success ">
               <span class="icone-botoes-acao mdi mdi-send"></span>
               <span class="texto-botoes-acao"> Salvar </span>
               <div class="ripple-container"></div>
            </button>

	        	<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary" href="http://gesol.dev/solicitacao">
               <span class="icone-botoes-acao mdi mdi-backburger"></span>   
               <span class="texto-botoes-acao"> Cancelar </span>
               <div class="ripple-container"></div>
            </button>
			</div>

		</form>
	</div>
</div>
    
@endsection

@push('scripts')

@endpush