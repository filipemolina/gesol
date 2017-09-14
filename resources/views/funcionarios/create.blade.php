@extends("layouts.material")

@section('content')

<div class="col-md-8 col-md-offset-3">
	<div class="card card-singup">
		<form method="get" action="/" class="form-horizontal">
			
			{{-- Ícone título --}}
			<div class="card-header card-header-icon" data-background-color="dourado">
				<i class="material-icons">person</i>
			</div>

			{{-- Título --}}
			<div class="card-content">
				<h4 class="card-title no-padding">Registrar de funcionário</h4>
			</div>			
			
			<div class="row">
				
				{{-- Dados --}}
				<div class="col-md-7">
						<div class="card-content no-padding">
							<div class="input-group ">
								<span class="input-group-addon ">
									<i class="material-icons">face</i>
								</span>

								<div class="form-group label-floating has-dourado">
									<label class="control-label">Nome</label>
									<input type="text" class="form-control error" 
									value="">
								</div>
							</div>

							<div class="input-group">
	                        	<span class="input-group-addon">
									<i class="material-icons">email</i>
								</span>
	                            
	                            <div class="form-group label-floating has-dourado">
									<label class="control-label">Email</label>
									<input type="text" name="email" type="email" class="form-control error" 
									value="">
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="input-group">
			                        	<span class="input-group-addon">
											<i class="material-icons">credit_card</i>
										</span>
			                            
			                            <div class="form-group label-floating has-dourado">
											<label class="control-label">CPF</label>
											<input id="cpf" type="text" class="form-control error" 
											value="">
										</div>
									</div>
								</div>

								
								<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">credit_card</i>
										</span>

										<div class="form-group label-floating has-dourado">
											<label class="control-label">Matrícula</label>
											<input id="matricula" type="text" class="form-control error" 
											value="">
										</div>
									</div>
								</div>
							</div>

							<div class="input-group">
	                        	<span class="input-group-addon">
									<i class="material-icons">account_balance</i>
								</span>

								<div class="control form-group label-floating has-dourado">
									<label class="control-label">Cargo</label>
									<select class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
										<option disabled selected>Cargo</option>
										<option value="2">Secretário</option>
										<option value="3">Subsecretário</option>
									</select>
								</div>
							</div>
							
							<div class="input-group">
	                        	<span class="input-group-addon">
	                            	<i class="material-icons">lock_outline</i>
								</span>
	                            <div class="form-group label-floating has-dourado">
									<label class="control-label">Senha</label>
									<input type="password" name="password" class="form-control error" 
									value="">
								</div>
							</div>
	                        <div class="input-group">
	                        	<span class="input-group-addon">
	                            	<i class="material-icons">lock_outline</i>
								</span>
	                            <div class="form-group label-floating has-dourado">
									<label class="control-label">Confirmar senha</label>
									<input type="password" name="password" type="password" class="form-control error" 
									value="">
								</div>
	                        </div>
						</div>
				</div>

				{{-- Foto --}}
				<div class="col-md-4 flt-r no-padding">
					<div class="fileinput fileinput-new text-center" data-provides="fileinput">
	                	<div class="fileinput-new thumbnail img-circle">
	                    	<img src="{{ asset ('img/placeholder.jpg') }}" alt="...">
	                   	</div>

	                    <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
	                    <div>
		                    <span class="btn btn-round btn-dourado btn-file">
			                    <span class="fileinput-new">Adicionar</span>
			                    <span class="fileinput-exists">Alterar</span>
			                    <input type="file" name="..." />
		                    </span>
							<br />
		                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
	                    </div>
					</div>
				</div>
			</div> {{-- FIM ROW --}}

			<div class="footer text-center">
	        	<a href="#pablo" class="btn btn-dourado btn-wd ">Salvar</a>
			</div>

		</form>
	</div>
</div>
    
@endsection