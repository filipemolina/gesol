@extends('layouts.material')

@section('titulo')

Novo Relatorio

@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-success card-header-icon">
				<div class="card-icon" style="background: linear-gradient(60deg, #BFA15F, #ad7909);box-shadow: 0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(191, 161, 95, 0.4);">
					<i class="material-icons">chat bubble</i>
				</div>
				<h4 class="card-title">Novo Relatorio</h4><h5 style="color:black">* Campos Obrigatorios</h5>
			</div>
			<div class="card-body">
				<form action="{{ url('/semsop') }}" method="POST" id="form_relatorio">
					{{ csrf_field() }}
					<!-- ============================CHECKBOX============================ -->
					<div class="row col-md-offset-2 col-sm-offset-2 col-md-12 col-sm-12" >
						<div class="card-content">
							<div class="form-check form-check-inline">
								<label class="form-check-label" style="color:black;" >
										<input class="form-check-input" name="notificacao" value="notificacao" type="checkbox"> Notificação
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label" style="color:black;">
									<input class="form-check-input" value="autuacao" name="autuacao" type="checkbox"> Autuação
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label" style="color:black;">
									<input class="form-check-input" value="multa" name="multa" type="checkbox"> Multa
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label" style="color:black;">
									<input class="form-check-input" value="registro_dp" name="registro_dp" type="checkbox"> Registo em DP
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label" style="color:black;">
									<input class="form-check-input" value="auto_pf" name="auto_pf" type="checkbox"> A.P.F
										<span class="form-check-sign">
											<span class="check"></span>
										</span>
								</label>
							</div>
						</div>
					</div>
					<br><br><br><br>
					<!-- ============================FIM CHECKBOX============================ -->
					
					<!-- ============================   SELECT   ============================ -->
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="input-group-prepend">
								*<span class="input-group-text">
									<i class="material-icons">swap_horiz</i>
								</span>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">Selecione a origem do serviço</label>
										<select name="origem" id=origem class="form-control form-control error" style="position: inherit;" required>
											<option value="" selected> </option>
											@foreach($origens as $origem)
												<option value="{{$origem}}"> {{$origem}} </option> 
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="input-group-prepend">
								*<span class="input-group-text">
									<i class="material-icons">card_membership</i>
								</span>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">Selecione a ação desenvolvida</label>
										@if($fiscal)
											<select name="acao_cop" id="acao_cop" class="form-control form-control error" style="position: inherit;" required>
												<option value="">  </option>
												@foreach($acoes_cop as $acao_cop)
													<option value="{{$acao_cop}}"> {{$acao_cop}}</option>
												@endforeach 
										@elseif($guarda)
											<select name="acao_gcmm" id="acao_gcmm " class="form-control form-control error" style="position: inherit;" required> 	 
												 <option value="">  </option>
												@foreach($acoes_gcmm as $acao_gcmm)
													<option value="{{$acao_gcmm}}"> {{$acao_gcmm}}</option>
												@endforeach
										@endif
											</select>
									</div>
								</div>	
							</div>
						</div>
					</div>
					<br>
					<!-- ============================ FIM SELECT ============================ -->
					
					<!-- =========================== DATA E HORA  =========================== -->
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="input-group-prepend">
								*<span class="input-group-text">
									<i class="material-icons">event</i>
								</span>
								<div class="form-group label-floating has-roxo is-empty" style="padding-left: 10px;">
									<label class="control-label" style="font-size: 11.7px;">Data</label>
									<input id="data" name="data" type="date" class="form-control" value="" required>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-md-4 col-md-offset-3">
							<div class="input-group-prepend">
								*<span class="input-group-text">
									<i class="material-icons">access_time</i>
								</span>
								<div class="form-group label-floating has-roxo is-empty" style="padding-left: 10px;">
									<label class="control-label" style="font-size: 11.7px;">Hora</label>
									<input name="hora" type="time" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
					<br>
					<!-- ========================= FIM DATA E HORA  ========================= -->

					<!-- ========================     ENDEREÇO      ========================= -->
					<div class="row ">
						<div class="col-xs-12 col-sm-6 col-md-4">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="material-icons">mail_outline</i>
								</span>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">CEP</label>
										<input id="cep" name="cep" type="text" class="form-control error" value="" onblur="pesquisacep(this.value);">
									</div>
								</div>
							</div>
						</div>
						<input name="municipio" type="text" id="municipio" size="40" class="hide" />		
						<div class="col-xs-12 col-sm-6 col-md-8">	
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="material-icons">explore</i>
								</span>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">Bairro</label>
										<input id="bairro" name="bairro" type="text" class="form-control error" value="">
									</div>
								</div>
							</div>
						</div>			
					</div>
					<br>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-7">
							<div class="input-group-prepend">
								<span class="input-group-text">
									<i class="material-icons">call_split</i>
								</span>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">Logradouro</label>
										<input id="logradouro" name="logradouro" type="text" class="form-control error" value="">
									</div>		
								</div>					
							</div>
						</div>
						<div class="col-xs-6 col-md-2">
							<div class="input-group-prepend">	
								<span class="input-group-text">
									<i class="material-icons">home</i>
								</span>
								<div class="form-group label-floating has-roxo is-empty">
									<label class="control-label" style="font-size: 11.7px;">Numero</label>
									<input id="numero" name="numero" type="number" class="form-control error" value="">
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="input-group-prepend"> 
								<span class="input-group-text">
									<i class="material-icons">explore</i>
								</span>
								<div class="form-group label-floating has-roxo is-empty">
									<label class="control-label" style="font-size: 11.7px;">Complemento</label>
									<input id="complemento" name="complemento" type="text" class="form-control error" value="">
								</div>
							</div>
						</div>
					</div>
					<br>
					<!-- ========================  FIM  ENDEREÇO    ========================= -->

					<!-- ========================   AREA DE TEXTO   ========================= -->
					<div class="row">
						<div class="card-content">
							<div class="input-group-prepend">
								*<span class="input-group-text">
									<i class="material-icons">group</i>
								</span>
								<div class="col-xs-11 col-sm-11 col-md-11">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">Envolvidos</label>
										<textarea id="envolvidos" name="envolvidos" type="text" class="form-control"  rows="2" required></textarea>
										<span class="material-input"></span>
										<span class="material-input"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="card-content">
							<div class="input-group-prepend">
								*<span class="input-group-text">
									<i class="material-icons">insert_comment</i>
								</span>
								<div class="col-xs-11 col-sm-11 col-md-11">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">Relato Sucinto</label>
										<textarea id="relato" name="relato" type="text" class="form-control"  rows="2" required></textarea>
										<span class="material-input"></span>
										<span class="material-input"></span>
									</div>
								</div>
							</div>	
						</div>
					</div>
					<br>
					<div class="row">
						<div class="card-content">
							<div class="input-group-prepend">
								*<span class="input-group-text">
									<i class="material-icons">mode_edit</i>
								</span>
								<div class="col-xs-11 col-sm-11 col-md-11">
									<div class="form-group label-floating has-roxo is-empty">
										<label class="control-label" style="font-size: 11.7px;">Providências Adotadas</label>
										<textarea id="providencia" name="providencia" type="text" class="form-control"  rows="2" required></textarea>
										<span class="material-input"></span>
										<span class="material-input"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- =========================  FIM AREA DE TEXTO  ========================= -->

					<!-- =============  ADICIONAR OUTROS FUNCIONARIOS NO RELATORIO  ============ -->
					<div class="row">
						<div id="funcionario">
							<div class="small-12 columns text-right">
								<center>
									<h4>ADICIONAR INTEGRANTES AO FORMULARIO</h4>
									<button type="button" class="small tiny alert clonador btnfuncionario"></button>
								</center>
							</div>
							<div class="row box_funcionario hide">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="material-icons">perm_identity</i>
                              </span>
                              <div class="col-xs-11 col-sm-11 col-md-11">
										<div class="form-group label-floating has-roxo is-empty">
											<label class="control-label">Adicionar Funcionarios</label>
											<select name="funcionario_id[]" id="funcionario_id" class="form-control form-control error" style="position: inherit;">
												<option value=""></option>		
												@foreach($funcionarios as $funcionario)
													<option value="{{ $funcionario['id'] }}"> {{ $funcionario['nome'] }} </option>
												@endforeach
											</select>
											<span class="material-input"></span>
										</div>
                           </div>
									</div>
								</div>	
								<div class="col-xs-12 col-md-2">
									<div class="input-group">
										<input type="button" class="button tiny success btn_remove" value="Remover"  />
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- ===========  FIM ADICIONAR OUTROS FUNCIONARIOS NO RELATORIO  ========== -->

					<!-- =============================   IMAGEM   ============================== -->
					<div>
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
					<!-- ==========================   FIM IMAGEM   ============================= -->
					<!-- ============================BOTOES============================ -->
					<div class="row">
						<center>
							<button type="submit" id="enviar-relatorio" class="botoes-acao btn btn-round btn-success enviar-relatorio">
								<span class="icone-botoes-acao mdi mdi-send"></span>
								<span class="texto-botoes-acao"> ENVIAR </span>
								<div class="ripple-container"></div>
							</button>
						
							<button id="btn_cancelar" class="botoes-acao btn btn-round btn-primary">
								<span class="icone-botoes-acao mdi mdi-backburger"></span>   
								<span class="texto-botoes-acao"> CANCELAR </span>
								<div class="ripple-container"></div>
							</button>
						</center>
					</div>
					<!-- ============================FIM BOTOES============================ -->
				</form>	
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')

	<script type="text/javascript">
		$(function(){

			$('body').submit(function(event){
				if ($(this).hasClass('enviar-relatorio')) {
					event.preventDefault();
				}
				else {
					$(this).find(':submit').html('<i class="fa fa-spinner fa-spin"></i>');
					$(this).addClass('enviar-relatorio');
				}
			});

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

			// Mascara
			VMasker ($("#cep")).maskPattern("99999-999");

			$('.clonador').click(function(){
			    $clone = $('.box_funcionario.hide').clone(true);
			    $clone.removeClass('hide');
			    $('#funcionario').append($clone);
			});

			$('.btn_remove').click(function(){
			    $(this).parents('.box_funcionario').remove();
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
			  window.location.href='/semsop';
	      });

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
