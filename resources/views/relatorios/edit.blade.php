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
		<form action="{{ url("semsop/$relatorio->id") }}" method="POST" id="form_relatorio">
			{!! method_field('PUT') !!}
				{{ csrf_field() }}
  

		<!-- ============================CHECKBOX============================ -->
		
			<div class="row col-md-offset-2 col-sm-offset-2 col-md-12 col-sm-12" >
				<div class="card-content">
					<label style="color: #000; margin-left: 15px">
					<input type="checkbox" name="notificacao" value="1" 
					    @if(old('notificacao',$relatorio->notificacao))
					        checked
					    @endif
					    > Notificacão<br>
						{{-- <input value="notificacao" name="notificacao" type="checkbox"> Notificação --}}
					</label>
					<label style="color: #000; margin-left: 15px">
						<input type="checkbox" name="autuacao" value="1" 
					    @if(old('autuacao',$relatorio->autuacao))
					        checked
					    @endif
					    > Autuação<br>
						{{-- <input value="autuacao" name="autuacao" type="checkbox"> Autuação --}}
					</label>
					<label style="color: #000; margin-left: 15px">
						<input type="checkbox" name="multa" value="1" 
					    @if(old('multa',$relatorio->multa))
					        checked
					    @endif
					    > Multa<br>
						{{-- <input value="multa" name="multa" type="checkbox"> Multa --}}
					</label>
					<label style="color: #000; margin-left: 15px">
						<input type="checkbox" name="registro_dp" value="1" 
					    @if(old('registro_dp',$relatorio->registro_dp))
					        checked
					    @endif
					    > Registo em DP<br>
						{{-- <input value="registro_dp" name="registro_dp" type="checkbox"> Registo em DP --}}
					</label>
					<label style="color: #000; margin-left: 15px">
						<input type="checkbox" name="auto_pf" value="1" 
					    @if(old('auto_pf',$relatorio->auto_pf))
					        checked
					    @endif
					    > A.P.F<br>
						{{-- <input value="auto_pf" name="auto_pf" type="checkbox"> A.P.F --}}
					</label>
				</div>
			</div>
		<!-- ============================FIM CHECKBOX============================ -->
		
	 	<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="input-group" >
					<span class="input-group-addon">
						<i class="material-icons">swap_horiz</i>
					</span>

					<div class="form-group label-floating has-roxo is-empty">
						<label class="control-label">Selecione a origem do serviço</label>
						<select name="origem" id=origem class="form-control form-control error">
							<option value="" selected> </option>
							@foreach($origens as $origem)
								@if($origem == $relatorio->origem)
									<option value="{{$origem}}" selected> {{$origem}} </option>    
								@else
									<option value="{{$origem}}"> {{$origem}} </option>    
								@endif
							@endforeach
						</select>
						<span class="material-input"></span>
					</div>
				</div>
			</div>
			 


		    <div class="col-xs-12 col-sm-6 col-md-6">
				<div class="input-group" >
					<span class="input-group-addon">
						<i class="material-icons">card_membership</i>
					</span>
					<div class="form-group label-floating has-roxo is-empty">
						<label class="control-label">Selecione a ação desenvolvida</label>
			@if($funcionario_logado->atribuicoes()->where('atribuicao', 'SEMSOP_REL_FISCAL')->count() )  
						<select name="acao_cop" id="acao_cop" class="form-control form-control error">
							<option value="">  </option>
							@foreach($acoes_cop as $acao_cop)
								@if($acao_cop == $relatorio->acao_cop)
									<option value="{{$acao_cop}}" selected> {{$acao_cop}}</option>
								@else
									<option value="{{$acao_cop}}"> {{$acao_cop}}</option>
								@endif
							@endforeach 
			@elseif($funcionario_logado->atribuicoes()->where('atribuicao', 'SEMSOP_REL_GCMM')->count() )
						<select name="acao_gcmm" id="acao_gcmm " class="form-control form-control error"> 	  <option value="">  </option>
							@foreach($acoes_gcmm as $acao_gcmm)
								@if($acao_gcmm == $relatorio->acao_gcmm)
									<option value="{{$acao_gcmm}}" selected> {{$acao_gcmm}}</option>
								@else
									<option value="{{$acao_gcmm}}"> {{$acao_gcmm}}</option>
								@endif
							@endforeach
						@endif	
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
			<!-- ============================lOCAL============================ -->
			<div class="row ">
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">mail_outline</i>
						</span>
							<div class="form-group label-floating has-roxo is-empty">
								<label class="control-label">CEP</label>
								<input id="cep" name="cep" type="text" class="form-control error" value="{{ $relatorio->endereco->cep or old('cep')}}" onblur="pesquisacep(this.value);">
								<span class="material-input"></span>
							</div>
						</div>
					</div>

					<input name="municipio" type="text" id="municipio" size="40" value="{{$relatorio->endereco->municipio}}" class="hide" />
					
					<div class="col-xs-12 col-sm-6 col-md-8">	
						<div class="input-group">
							<span class="input-group-addon">
								<i class="material-icons">explore</i>
							</span>
							<div class="form-group label-floating has-roxo is-empty">
								<label class="control-label">Bairro</label>
								<input id="bairro" name="bairro" type="text" class="form-control error" value="{{ $relatorio->endereco->bairro or old('bairro')}}">
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
							<label class="control-label">Logradouro</label>
							<input id="logradouro" name="logradouro" type="text" class="form-control error" value="{{ $relatorio->endereco->logradouro or old('logradouro')}}">
							
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
							<input id="numero" name="numero" type="text" class="form-control error" value="{{ $relatorio->endereco->numero or old('numero')}}">
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
							<input id="complemento" name="complemento" type="text" class="form-control error" value="{{ $relatorio->endereco->complemento or old('complemento')}}">
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
							<textarea id="envolvidos" name="envolvidos" type="text" class="form-control"  rows="2" >{{$relatorio->envolvidos or old('envolvidos')}}</textarea>
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
							<textarea id="relato" name="relato" type="text" class="form-control"  rows="2"
							>{{$relatorio->relato or old('relato')}}</textarea>
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
							<textarea id="providencia" name="providencia" type="text" class="form-control"  rows="2">{{$relatorio->providencia or old('providencia')}}</textarea>
							<span class="material-input"></span>
						</div>
					</div>
				</div>
		 	</div>
			
			
			
			<!-- ============================FIM AREA DE TEXTO============================ -->
			
			<!-- =============ADICIONAR OUTROS FUNCIONARIOS NO RELATORIO=========== -->
			
			<div class="row">
				<div id="funcionario">
					<div class="small-12 columns text-right">
    		 			<center>
    		 				<h4>ADICIONAR INTEGRANTES AO FORMULARIO</h4>
    		 				<button type="button" class="small tiny alert clonador btnfuncionario"></button>
    		 			</center>
 					</div>
					@foreach($relatorio->funcionarios as $funcionario_incluso)
						{{-- {{ dd($relatorio->funcionarios) }} --}}
						@if(! $funcionario_incluso->pivot->relator )
		 					<div class="row box_funcionario">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">perm_identity</i>
										</span>
										<div class="form-group label-floating has-roxo is-empty">
											<label class="control-label">Adicionar Funcionarios</label>
												<select name="funcionario_id[]" id="funcionario_id" class="form-control form-control error">

										    		@foreach($funcionarios as $funcionario)
														
										    		 	@if($funcionario->nome == $funcionario_incluso->nome)
															<option 
																value="{{ $funcionario->id }}" selected> {{ $funcionario->nome }}
															</option>
														@else
															<option 
																value="{{ $funcionario->id }}"> {{ $funcionario->nome }}
															</option> 
														@endif
													@endforeach
												</select>
											<span class="material-input"></span>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-md-2">
									<div class="input-group" style="padding-top: 28px;" >
		        						<input  type="button" class="button tiny success btn_remove" value="Remover" />
		    						</div>
		    					</div>
							</div>
						@endif

					@endforeach
					<div class="row box_funcionario hide">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="material-icons">perm_identity</i>
								</span>
								<div class="form-group label-floating has-roxo is-empty">
									<label class="control-label">Adicionar Funcionarios</label>
									<select name="funcionario_id[]" id="funcionario_id" class="form-control form-control error">
										<option value=""></option>

										 @foreach($funcionarios as $funcionario)
										<option value="{{ $funcionario->id }}"> {{ $funcionario->nome }} </option> 
										@endforeach

									</select>
									<span class="material-input"></span>
								</div>
							</div>
			    			</div>
							<div class="col-xs-12 col-md-2">
							<div class="input-group" style="padding-top: 28px;" >
        						<input type="button" class="button tiny success btn_remove" value="Remover" />
    						</div>
    					</div>
					</div> 
				</div>
			</div>




			<!-- =============FIM ADICIONAR OUTROS FUNCIONARIOS NO RELATORIO=========== -->


			<!-- ============================IMAGEM============================ -->
			
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

    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('logradouro').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('municipio').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('municipio').value=(conteudo.localidade);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logradouro').value="...";
                document.getElementById('bairro').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor
            limpa_formulário_cep();
        }
    };

	</script>

@endpush
   