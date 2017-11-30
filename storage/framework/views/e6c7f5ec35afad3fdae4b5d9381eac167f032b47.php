<?php $__env->startSection('titulo'); ?>

Solicitações

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('lightbox2/dist/css/lightbox.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
   <div class="col-md-12">
      
      <div class="col-md-12 gesol-panel card card-product" style="padding: 35px;">
         
         <div class="row">
            
            <div class="col-md-6 ">
               
               <div>
                  <div class="card-header card-header-icon avatar-fixo-pn foto-user">
                     <img class="img" src="<?php echo e($solicitacao->solicitante->foto); ?>"/>
                  </div>
               </div>

               <div class="nome-solicitante-card info-solictante" style="margin-top: -17px;">
                  <?php echo e($solicitacao->solicitante->nome); ?>

               </div>

               <div class="data-inclusao-card info-solictante">
                  Adicionado <?php echo e($solicitacao->created_at->diffForHumans() 
                     .' - ' 
                     .'('. $solicitacao->created_at->format('H:i:s -- d/m/Y').')'); ?>  
               </div>

               <div class="row">
                  <div class="timeline-body">
                     <div id="setor-cor" class="card-header card-header-icon icon-secretaria avatar-status pull-right" data-background-color 
                           style="background-color: <?php echo e($solicitacao->servico->setor->cor); ?>;">
                        <span id="setor-icone" class="mdi <?php echo e($solicitacao->servico->setor->icone); ?>" style="font-size: 30px">build</span>
                     </div>

                     <div data-lightbox="foto-solicitacao"  class="card-image" style="width: 75%; margin-left: 36px; top:-34px;">
                        <a href="<?php echo e($solicitacao->foto); ?>">
                           <img class="img" src="<?php echo e($solicitacao->foto); ?>">
                        </a>
                     </div>

                  </div>
               </div>
            </div>

            

            <div class="col-md-6">

               <div id="servico">
                  <h4> Destino da Solicitação: </h4>
                  <div id="servico-texto">
                     <?php echo e($solicitacao->servico->setor->secretaria->sigla); ?> - 
                     <?php echo e($solicitacao->servico->setor->nome); ?> - 
                     <?php echo e($solicitacao->servico->nome); ?>       
                  </div>    
               </div>

               <div id="servico-edicao" style="display: none;">
                  <h4> Redirecionar solicitação </h4>    
                  

                     <div class="label-floating " style="border-style: dotted; padding: 6px;">
                        
                        <select id="select-servico" class="js-example-data-array" data-live-search="true" > 
                           <option value="" selected>Selecione novo destino</option>
                           <?php $__currentLoopData = $setores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <optgroup label="<?php echo e($setor->nome); ?>">
                                 <?php $__currentLoopData = $setor->servicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($servico->id); ?>"><?php echo e($servico->nome); ?></option>  
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </optgroup>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        
                        <select id="select-servico-motivo" class="js-example-data-array" data-live-search="true" > 
                           <option value="" selected>Selecione uma motivo</option>
                           <?php $__currentLoopData = $motivos_transferencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($motivo); ?>"><?php echo e($motivo); ?></option>  
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                     </div>


               </div>

               <br>
               <div id="linha"></div>
               
               <h4>Endereço</h4>

               <span class="endereco" 
                  onclick="mostraMapa(<?php echo e($solicitacao->endereco->latitude); ?>,<?php echo e($solicitacao->endereco->longitude); ?>,<?php echo e($solicitacao->id); ?>);">
                  <i class="material-icons" style="font-size: 20px; margin-top: 5px;">place</i>  

                  <?php echo e($solicitacao->endereco->logradouro); ?> 
                  <?php echo e($solicitacao->endereco->numero); ?> -
                  <?php echo e($solicitacao->endereco->bairro); ?> -
                  <?php echo e($solicitacao->endereco->cep); ?> 
               </span>

               <br><br>
               <div id="linha"></div>
               <h4>Conteúdo</h4>

               <div id="conteudo">
                  <?php echo $solicitacao->conteudo; ?>

               </div>

               <div id="conteudo-edicao" style="display: none;">
                  <!-- <textarea id="textarea-edicao" rows="5" cols="60" name="conteudo">{! $solicitacao->conteudo !!}</textarea> -->
                  <div id="textarea-edicao" name="conteudo" contenteditable="true" style="border-style: dotted; padding: 6px;">
                        <?php echo $solicitacao->conteudo; ?>

                  </div>
               </div>
            </div>
         </div> 

         <div id="LocalMapa_<?php echo e($solicitacao->id); ?>" class=" row mapa"></div>

         <div class="row">

            
            
            <div id="botao-padrao" style="text-align:center; margin-top: 20px;">
               <button class="botoes-acao btn btn-round btn-success libera-solicitacao">
                  <span class="icone-botoes-acao mdi mdi-send"></span>
                  <span sclass="texto-botoes-acao"> Liberar </span>
               </button>

               <button style="background: #1d1617;" class="botoes-acao btn btn-round edita-solicitacao" >
                  <span class="icone-botoes-acao mdi mdi-comment-remove-outline"></span>
                  <span sclass="texto-botoes-acao">  Editar </span>
               </button>

               <button class="botoes-acao btn btn-round btn-warning redireciona-solicitacao">
                  <span class="icone-botoes-acao mdi mdi-redo-variant"></span>
                  <span sclass="texto-botoes-acao"> Redirecionar </span>
               </button>

               <button class="botoes-acao btn btn-round btn-danger recusa-solicitacao">
                  <span class="icone-botoes-acao mdi mdi-delete-sweep"></span>
                  <span sclass="texto-botoes-acao"> Recusar </span>
               </button>

               <a class="botoes-acao btn btn-round btn-primary" href="<?php echo e(URL::previous()); ?>">
                  <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                  <span sclass="texto-botoes-acao"> Voltar </span>
               </a>
            </div>

            
            <div id="botao-conteudo" style="text-align:center; display: none; margin-top: 20px;">
               <button class="botoes-acao btn btn-round btn-success salva-conteudo">
                  <span class="icone-botoes-acao mdi mdi-send"></span>
                  <span sclass="texto-botoes-acao"> Salvar </span>
               </button>
               
               <button class="botoes-acao btn btn-round btn-danger impropria">
                  <span class="icone-botoes-acao mdi mdi-emoticon-poop"></span>   
                  <span sclass="texto-botoes-acao"> Palavra impropria </span>
               </button>

               <button class="botoes-acao btn btn-round btn-primary cancela-conteudo">
                  <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                  <span sclass="texto-botoes-acao"> Cancelar </span>
               </button>
            </div>

            
            <div id="botao-servico" style="text-align:center; display: none; margin-top: 20px;">
               <button class="botoes-acao btn btn-round btn-success salva-servico">
                  <span class="icone-botoes-acao mdi mdi-send"></span>
                  <span sclass="texto-botoes-acao"> Salvar </span>
               </button>
               
               <button class="botoes-acao btn btn-round btn-primary cancela-servico">
                  <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                  <span sclass="texto-botoes-acao"> Cancelar </span>
               </button>
            </div>
         </div>
      </div>
   </div>
</div>


<form action="<?php echo e(url("/modera")); ?>" method="POST" id="form-hidden" style="visibility: hidden">
  <?php echo e(csrf_field()); ?>

  <input type="hidden" value="<?php echo e($solicitacao->id); ?>" name="solicitacao_id">
  <input type="hidden" value="" name="acao" id="hidden_acao">
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
   <script src="<?php echo e(asset('lightbox2/dist/js/lightbox.min.js')); ?>"></script>

   <script>
      /*================================ LIBERAR =========================================*/
      $(".libera-solicitacao").click(function(){
         event.preventDefault();

         swal({
            title: 'Libera essa Solicitação?',
            text: "Ela ficará visível na Timeline360!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, está ok!'
         }).then(function () {
            swal(
               'Solicitação liberada!',
               '',
               'success'
            ).then(function(){

               $("input#hidden_acao").val('1');

               $("form#form-hidden").submit();
            });
         })
      });

      /*================================ EDITAR =========================================*/
      $(".edita-solicitacao").click(function(){
         event.preventDefault();

         $("#conteudo").hide(); 
         $("#conteudo-edicao").css('display', 'block'); 
         $("#botao-padrao").hide();
         $("#botao-conteudo").css('display', 'block'); 
      });

      $(".cancela-conteudo").click(function(){
         event.preventDefault();

         $("#conteudo").show(); 
         $("#conteudo-edicao").css('display', 'none'); 
         $("#botao-padrao").show();
         $("#botao-conteudo").css('display', 'none'); 
      });

      $(".salva-conteudo").click(function(){
         event.preventDefault();

         swal({
            title: 'Salvar a alteração no conteúdo?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
         }).then(function () {
            swal(
               'Conteúdo alterado!',
               '',
               'success'
            ).then(function(){

               // Estética

     
               let conteudo = $("#textarea-edicao").html().trim();

               $("#conteudo").html( conteudo );
               $("#conteudo-edicao").css('visibility', 'hidden');
               $("#conteudo").show(); 
               $("#conteudo-edicao").css('visibility', 'hidden'); 
               $("#botao-padrao").show();
               $("#botao-conteudo").css('visibility', 'hidden'); 

               // Levantamento de peso

               $.post('/solicitacao/<?php echo e($solicitacao->id); ?>', {
                  _token : '<?php echo e(csrf_token()); ?>',
                  _method: 'PUT',
                  conteudo: conteudo,
                  acao:    2
               }, function(resposta){
                  console.log(resposta);
               });
            });
         })
      });

      $(".impropria").click(function(){
         event.preventDefault();

         trocaTexto("textarea-edicao", " [EDITADO - palavra imprópria] ");
         
      });
      
      
     /*================================ REDIRECIONAR =========================================*/
      $(".redireciona-solicitacao").click(function(){
         event.preventDefault();
         $("#servico").css('display', 'none');
         $("#botao-padrao").css('display', 'none');

         $("#servico-edicao").css('display', 'block'); 
         $("#botao-servico").css('display', 'block'); 
      });

      $(".cancela-servico").click(function(){
         event.preventDefault();

         $("#servico").css('display', 'block'); 
         $("#botao-padrao").css('display', 'block'); 

         $("#servico-edicao").css('display', 'none'); 
         $("#botao-servico").css('display', 'none'); 
      });

      $(".salva-servico").click(function(){
         event.preventDefault();

         if (  $("#select-servico").val() == '' && $("#select-servico-motivo").val() == ''  ){
            demo.notificationRight("top", "right", "rose", "Selceiono um Destino");     
            demo.initFormExtendedDatetimepickers();
            demo.notificationRight("top", "right", "rose", "Selecione um motivo");
            demo.initFormExtendedDatetimepickers();
         
         } else if (  $("#select-servico").val() == '' ) {

            demo.notificationRight("top", "right", "rose", "Selceiono um Destino");     
            demo.initFormExtendedDatetimepickers();

         } else if (  $("#select-servico-motivo").val() == '' ) {

            demo.notificationRight("top", "right", "rose", "Selecione um motivo");
            demo.initFormExtendedDatetimepickers();

         } else {

            swal({
               title: 'Redirecionar a solicitação para o destino escolhido?',
               text: $("#select-servico option:selected").html(),
               type: 'question',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Sim',
               cancelButtonText: 'Não',
            }).then(function () {
               swal(
                  'Destino alterado!',
                  '',
                  'success'
               ).then(function(){

                  // Estética

                  let id_servico = $("#select-servico").val();

                  let textoSelecionado = $("#select-servico option:selected").text();

                  $("#servico").css('display', 'block'); 
                  $("#botao-padrao").css('display', 'block'); 
                  
                  $("#servico-edicao").css('display', 'none');             
                  $("#botao-servico").css('display', 'none');  

                  // Levantamento de peso

                  $.post('/solicitacao/<?php echo e($solicitacao->id); ?>', {
                     _token :    '<?php echo e(csrf_token()); ?>',
                     _method:    'PUT',
                     servico_id: id_servico,
                     motivo: $("#select-servico-motivo option:selected").html(),
                     acao:       3
                  }, function(res){
                     let resposta = JSON.parse(res);

                     $("#servico-texto").html(  resposta.sigla +' - ' + 
                                                resposta.servico +' - ' +
                                                resposta.setor );

                     $("#setor-icone").removeClass().addClass('mdi '+ resposta.icone);
                     $("#setor-cor").css('background-color', resposta.cor + " !important");

                     ///////////////////////////// Enviar comentário padrão

                     $.post(url_base+"/comentario",{
                        comentario: "A solicitação foi transferida pelo seguinte motivo: "+$("#select-servico-motivo option:selected").html(),
                        solicitacao_id: <?php echo e($solicitacao->id); ?>, 
                        funcionario_id: <?php echo e($funcionario->id); ?>,  //definido na material.blade
                        _token: token,
                     });

                     console.log("Resposta", resposta);

                  });
               });
            })
         };
      });

      /*================================ RECUSAR =========================================*/
      $(".recusa-solicitacao").click(function(){
         event.preventDefault();

         swal({
            title: 'Escolha o motivo da recusa',
            input: 'select',
            inputOptions: JSON.parse('<?php echo json_encode($motivos_recusa); ?>'),

   /*         inputOptions: {
               'Imagem impropria':                       'Imagem impropria',
               'Solicitação em duplicidade':             'Solicitação em duplicidade',
               'Não é de resposabilidade da Prefeitura': 'Não é de resposabilidade da Prefeitura'
            },
   */         inputPlaceholder: 'Selecione um motivo',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Recusar',
            showLoaderOnConfirm: true,

            inputValidator: function (value) {
               return new Promise(function (resolve, reject) {
                  if (value) {
                     resolve()
                  } else {
                     reject('Selecione um motivo')
                  }
               })
            }
         }).then(function (result) {
            swal(
               'Solicitação recusada!',
               '',
               'success'
            ).then(function(){
               $.post('/solicitacao/<?php echo e($solicitacao->id); ?>', {
                  _token : '<?php echo e(csrf_token()); ?>',
                  _method: 'PUT',
                  motivo: result,
                  status: "Recusada",
                  acao:    4
               }, function(resposta){
                  console.log(resposta);
                  window.location.href="<?php echo e(url("/")); ?>";
               });
            });
         })
      });


   </script>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.material', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>