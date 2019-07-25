@extends('layouts.material')

@section('titulo')

	Relatorios

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
            <form action="{{ url('/setrans') }}" method="POST" id="form_relatorio">
               {{ csrf_field() }}
               <div class="row">
                  <div class="col-md-2">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="material-icons">access_time</i>
                        </span>
                        <div class="form-group label-floating has-roxo is-empty" style="padding-left: 10px;">
                           <label class="control-label" style="font-size: 11.7px;">Cones</label>
                           <input name="cones" type="number" class="form-control" min="0" value="0" required>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="material-icons">access_time</i>
                        </span>
                        <div class="form-group label-floating has-roxo is-empty" style="padding-left: 10px;">
                           <label class="control-label" style="font-size: 11.7px;">Bombonas</label>
                           <input name="bombonas" type="number" class="form-control" min="0" value="0" required>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-2">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="material-icons">access_time</i>
                        </span>
                        <div class="form-group label-floating has-roxo is-empty" style="padding-left: 10px;">
                           <label class="control-label" style="font-size: 11.7px;">Radios</label>
                           <input name="radios" type="number" class="form-control" min="0" value="0" required>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-2">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="material-icons">access_time</i>
                        </span>
                        <div class="form-group label-floating has-roxo is-empty" style="padding-left: 10px;">
                           <label class="control-label" style="font-size: 11.7px;">Placas</label>
                           <input name="placas" type="number" class="form-control" min="0" value="0" required>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-2">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="material-icons">access_time</i>
                        </span>
                        <div class="form-group label-floating has-roxo is-empty" style="padding-left: 10px;">
                           <label class="control-label" style="font-size: 11.7px;">Lanternas</label>
                           <input name="lanternas" type="number" class="form-control" min="0" value="0" required>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="card-content">
                     <div class="input-group-prepend">
                        *<span class="input-group-text">
                           <i class="material-icons">insert_comment</i>
                        </span>
                        <div class="col-xs-11 col-sm-11 col-md-11">
                           <div class="form-group label-floating has-roxo is-empty">
                              <label class="control-label" style="font-size: 11.7px;">Outros Materiais</label>
                              <textarea id="outros" name="outros" type="text" class="form-control"  rows="2" required></textarea>
                              <span class="material-input"></span>
                              <span class="material-input"></span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>


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

               <div class="row">
                  <div class="card-content">
                     <div class="input-group-prepend">
                        *<span class="input-group-text">
                           <i class="material-icons">insert_comment</i>
                        </span>
                        <div class="col-xs-11 col-sm-11 col-md-11">
                           <div class="form-group label-floating has-roxo is-empty">
                              <label class="control-label" style="font-size: 11.7px;">Registro da Ocorrencia</label>
                              <textarea id="registro_ocorrencia" name="registro_ocorrencia" type="text" class="form-control"  rows="2" required></textarea>
                              <span class="material-input"></span>
                              <span class="material-input"></span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>


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
            </form>
            <!-- ============================FIM BOTOES============================ -->
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
  window.location.href='/setrans';
});

});


   </script>
@endpush