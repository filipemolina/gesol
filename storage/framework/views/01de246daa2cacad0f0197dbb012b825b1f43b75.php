<?php $__env->startSection('titulo'); ?>

Solicitações

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
   <link href="<?php echo e(asset('lightbox2/dist/css/lightbox.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

   <div class="row">
      <div class="col-md-12">
         
         <div class="col-md-12 gesol-panel card card-product" style="padding: 35px;margin-top: 15px;">
            
            <div class="row">
               
               <div class="col-md-5" style="padding-right: 0px;padding-left: 0px;">
                  
                  <div>
                     <div class="card-header card-header-icon avatar-fixo-pn foto-user">
                        <img class="img" src="<?php echo e($solicitacao->solicitante->foto); ?>"/>
                     </div>
                  </div>

                  <div class="nome-solicitante-card info-solictante" style="margin-top: -17px;">
                     <?php echo e($solicitacao->solicitante->nome); ?>

                  </div>

                  <div class="data-inclusao-card info-solictante">

                     Abertura: <?php echo e($solicitacao->created_at->format('H:i:s - d/m/Y')); ?>    
                     <br>
                     Prazo: 

                        <?php if(date('Ymd') > date('Ymd', strtotime($prazo_calculado)) ): ?>
                           <span id="span_prazo" class='badge' style='background-color:red'>     
                        <?php elseif( date('Ymd') == date('Ymd', strtotime($prazo_calculado)) ): ?>
                           <span id="span_prazo" class='badge' style='background-color:orange'>     
                        <?php else: ?>
                           <span id="span_prazo" class='badge' style='background-color:green'>     
                        <?php endif; ?>

                        <?php echo e(date('d/m/Y', strtotime($prazo_calculado))); ?>  
                     </span>

                     --- Status: 
                     <!-- <span class='badge' style='background-color:red'>  -->
                     
                     <?php if($solicitacao->status =='Aberta'): ?>

                        <span id="span_satus" class='badge status-aberta'> <?php echo $solicitacao->status; ?> </span>  

                     <?php elseif($solicitacao->status =='Em análise'): ?>

                           <span id="span_satus" class='badge status-analise'> <?php echo $solicitacao->status; ?> </span>  

                     <?php elseif($solicitacao->status =='Em execução'): ?>

                           <span id="span_satus" class='badge status-execucao'> <?php echo $solicitacao->status; ?> </span>  

                     <?php elseif($solicitacao->status =='Solucionada'): ?>

                           <span id="span_satus" class='badge status-solucionada'> <?php echo $solicitacao->status; ?> </span>  
                     
                     <?php elseif($solicitacao->status =='Recusada'): ?>

                           <span id="span_satus" class='badge status-recusada'> <?php echo $solicitacao->status; ?> </span>  

                     <?php elseif($solicitacao->status =='Encaminhada'): ?>

                           <span id="span_satus" class='badge status-encaminhada'> <?php echo $solicitacao->status; ?> </span>  

                     <?php endif; ?>

                  </div>

                  <div class="row">
                     <div class="timeline-body">
                        <div id="setor-cor" class="card-header card-header-icon icon-secretaria avatar-status pull-right" data-background-color 
                           style="background-color: <?php echo e($solicitacao->servico->setor->cor); ?>; left: 40px">
                           <span id="setor-icone" class="mdi <?php echo e($solicitacao->servico->setor->icone); ?>" style="font-size: 30px">build</span>
                        </div>

                        <div data-lightbox="foto-solicitacao"  class="card-image" style="width: 85%; margin-left: 36px; top:-30px;">
                           <a href="<?php echo e($solicitacao->foto); ?>">
                              <img class="img" src="<?php echo e($solicitacao->foto); ?>">
                           </a>
                        </div>

                        <div class="endereco" style="margin-left:36px; margin-top: -26px;"
                           onclick="mostraMapa(<?php echo e($solicitacao->endereco->latitude); ?>,<?php echo e($solicitacao->endereco->longitude); ?>,<?php echo e($solicitacao->id); ?>);">
                           <i class="material-icons" style="font-size: 20px; ">place</i>  

                           <?php echo e($solicitacao->endereco->logradouro); ?> 
                           <?php echo e($solicitacao->endereco->numero); ?> -
                           <?php echo e($solicitacao->endereco->bairro); ?> -
                           <?php echo e($solicitacao->endereco->cep); ?> 
                        </div>
                         
                     </div>
                  </div>
               </div>

               

               <div class="col-md-7" style="padding-left: 0px; padding-right: 0px;">

                  <div id="servico">
                     <h4 style="margin-bottom: 0px; margin-top: 0px;"> Destino da Solicitação: </h4>
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

                  
                  <div class="comentarios scroll-comentarios" id="div-comentarios">

                                          <div class="card-solicitante margin7" style="color: black; font-size: 12px;">
                           <div class="row" style="margin-left: 15px;margin-right: 15px;">
                              
                              <label class="h6 nome-solicitante">
                                 <?php echo e($solicitacao->solicitante->nome); ?>

                              </label>

                              
                              <div class="col-coment-fix" >
                                 <div class=" col-md-7 no-margin" >
                                    <p><?php echo e($solicitacao->conteudo); ?></p>
                                 </div>
                              </div>
                           </div>
                        
                        </div>


                     <?php $__currentLoopData = $solicitacao->comentarios->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="panel-body no-padding comentario_<?php echo e($comentario->id); ?>" >

                           
                           <?php if($comentario->funcionario): ?>                    
                              
                              <div class="card-secretaria card margin7" style="color: black; font-size: 12px;">
                                 <div class="row" style="margin-left: 15px;margin-right: 15px;">
                                    <label class="pull-right" style="color: #522d2d; font-size: 11px;"> 
                                       <?php echo e($comentario->created_at->format('H:i:s -- d/m/Y')); ?> 
                                    </label>
                                    
                                    
                                    <label class="h6  nome-solicitante">
                                       <?php echo e($comentario->funcionario->nome); ?> - 
                                       <?php echo e($comentario->funcionario->setor->nome); ?> - 
                                       <?php echo e($comentario->funcionario->setor->secretaria->sigla); ?>

                                    </label>

                                    
                                    <div class="col-coment-fix">
                                       <div class=" col-md-7 no-margin" >
                                          <p class="">
                                             <?php echo e($comentario->comentario); ?>

                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div> 
                           <?php else: ?>
                              
                              <div class="card-solicitante margin7" style="color: black; font-size: 12px;">
                                 <div class="row" style="margin-left: 15px;margin-right: 15px;">
                                    <label class="pull-right" style="color: #522d2d; font-size: 11px;"> 
                                       <?php echo e($comentario->created_at->format('h:m:s - j/m/Y')); ?> 
                                    </label>

                                    
                                    <label class="h6 nome-solicitante">
                                       <?php echo e($solicitacao->solicitante->nome); ?>

                                    </label>

                                    
                                    <div class="col-coment-fix" >
                                       <div class=" col-md-7 no-margin" >
                                          <p><?php echo e($comentario->comentario); ?></p>
                                       </div>
                                    </div>
                                 </div>
                              
                              </div>
                           <?php endif; ?>
                        
                        </div> 
                        
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

                  
                  <div id="div_escrever_comentario" class="input-group"  >
                     <textarea 
                           data-solicitacao="<?php echo e($solicitacao->id); ?>" 
                           data-funcionario="<?php echo e($funcionario_logado->id); ?>" 
                           id="comentario" 
                           name="comentario" 
                           class="form-control comentario comentario_<?php echo e($solicitacao->id); ?>" 
                           placeholder="Escreva um comentário" 
                           style="margin-top: 0px;padding-bottom: 0px;padding-top: 0px;">

                     </textarea>
                     <span class="input-group-addon">
                        <button type="button" 
                              id="enviar-comentario"
                              data-solicitacao="<?php echo e($solicitacao->id); ?>" 
                              data-funcionario="<?php echo e($funcionario_logado->id); ?>" 
                              class="btn btn-primary btn-sm enviar-comentario">
                           Enviar
                        </button>
                     </span>
                  </div>
                  
                  
               </div>
            </div> 

            <div class="row">
               <div id="div_por_em_execucao" style="display: none;">
                  <h4 style="margin-top: 0px;margin-bottom: 0px;"> Pôr em execução </h4>    
                  <div class="label-floating " style="border-style: dotted; padding: 6px;">
                     <div class="col-md-12">
                        <div class="col-md-4" style="margin-top: 8px;">
                           <span class="prazo-atual" >
                              Prazo Atual:  <?php echo e(date('d/m/Y', strtotime($prazo_calculado))); ?>  
                              <span class=" mdi mdi-arrow-right-bold"></span> 
                              <?php echo e($solicitacao->servico->prazo); ?> dias
                           </span>
                        </div>

                        <div class="col-md-4">
                           <span >
                              Novo Prazo: 
                              <input type="text" id="picker_data_prazo" class="form-control label-floating" 
                                 value="<?php echo e(date('d/m/Y', strtotime($prazo_calculado))); ?>"   
                              />
                              <span class=" mdi mdi-arrow-right-bold"></span>
                              <span id="label_dias_novo_prazo"> <?php echo e($solicitacao->servico->prazo); ?> dias </span>  
                           </span>
                        </div>

                        <div class="col-md-4" style="margin-top: 8px;">
                           <select id="select_prazo_motivo" class="select_prazo_motivo js-example-data-array" data-live-search="true" disabled> 
                              <option value="" selected>Selecione o motivo para alteração do Prazo</option>
                              <?php $__currentLoopData = $motivos_prazo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $motivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($motivo); ?>"><?php echo e($motivo); ?></option>  
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                        </div>
                     </div>

                    <div style="clear:both"></div> 
                  </div>
               </div>        
            </div>             

            <div class="col">
               
               
               <div id="div_botoes_iniciais" style="text-align:center; margin-top: -2px;">

                  
                  <?php if($solicitacao->status !='Em execução'): ?>
                     <button id="btn_por_execucao" class="botoes-acao-funcionario btn btn-round btn-success" >
                           <span class="icone-botoes-acao-funcionario mdi mdi-send"></span>
                           PÔR EM EXECUÇÃO 
                     </button>
                  <?php endif; ?>

                  <button id="btn_solucionar_solicitacao" class="botoes-acao-funcionario btn btn-round btn-success">
                     <span class="icone-botoes-acao-funcionario mdi mdi-send"></span>
                     SOLUCIONAR 
                  </button>


                  <button id="btn_redirecionar_solicitacao" class="botoes-acao-funcionario btn btn-round btn-warning">
                     <span class="icone-botoes-acao-funcionario mdi mdi-redo-variant"></span>
                     REDIRECIONAR
                  </button>

                  
                  <?php if($solicitacao->status !='Em execução'): ?>
                     <button id="btn_recusar_solicitacao" class="botoes-acao-funcionario btn btn-round btn-danger">
                        <span class="icone-botoes-acao-funcionario mdi mdi-delete-sweep"></span>
                        RECUSAR
                     </button>
                  <?php endif; ?>

                  <a class="botoes-acao-funcionario btn btn-round btn-primary" href="<?php echo e(URL::previous()); ?>">
                     <span class="icone-botoes-acao-funcionario mdi mdi-backburger"></span>   
                     VOLTAR
                  </a>
               </div>

               
               <div id="div_botoes_da_execucao" style="text-align:center; display: none; margin-top: 0px;">
                  <button id="btn_por_execucao_salvar" class="botoes-acao btn btn-round btn-success ">
                     <span class="icone-botoes-acao mdi mdi-send"></span>
                     <span class="texto-botoes-acao"> Salvar </span>
                  </button>

                  <button id="btn_por_execucao_cancelar" class="botoes-acao btn btn-round btn-primary cancela-execucao">
                     <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                     <span class="texto-botoes-acao"> Cancelar </span>
                  </button>
               </div>

               
               <div id="botao-servico" style="text-align:center; display: none; margin-top: 20px;">
                  <button class="botoes-acao btn btn-round btn-success salva-servico">
                     <span class="icone-botoes-acao mdi mdi-send"></span>
                     <span class="texto-botoes-acao"> Salvar </span>
                  </button>

                  <button class="botoes-acao btn btn-round btn-primary cancela-servico">
                     <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                     <span class="texto-botoes-acao"> Cancelar </span>
                  </button>
               </div>
            </div>
            
            <div id="LocalMapa_<?php echo e($solicitacao->id); ?>" class=" row mapa"></div>
            <form action="<?php echo e(url("/modera")); ?>" method="POST" id="form-hidden" style="visibility: hidden">
              <?php echo e(csrf_field()); ?>

              <input type="hidden" value="<?php echo e($solicitacao->id); ?>" name="solicitacao_id">
              <input type="hidden" value="" name="acao" id="hidden_acao">
            </form>
         </div>
      </div>
   </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
   <script src="<?php echo e(asset('lightbox2/dist/js/lightbox.min.js')); ?>"></script>
   <script src="<?php echo e(asset("js/handlebars.js")); ?>" type="text/javascript" charset="utf-8" async defer></script>
   <script src="<?php echo e(asset("js/pt-br.js" )); ?>"></script>

   <script>

      
      
      
      
      
      
      $("#btn_por_execucao").click(function(){
         event.preventDefault();
         console.log("asdasdjkhakd");
         //verifica o status da solicitação
         if( "<?php echo $solicitacao->status; ?>" != "Em execução")
         {
            $("#div_por_em_execucao").css('display', 'block');
            $("#div_botoes_iniciais").css('display', 'none');
            $("#div_escrever_comentario").hide();
            $("#div_botoes_da_execucao").css('display', 'block'); 

            // pega o Prazo original da solicitação
            let prazo_original = new Date('<?php echo e(substr($prazo_calculado, 4, 2)); ?>/<?php echo e(substr($prazo_calculado, 6, 2)); ?>/<?php echo e(substr($prazo_calculado, 0, 4)); ?>');

            //coloca o prazo original da solicitação nopicker
            $("#picker_data_prazo").val(moment(prazo_original).format("L   "));
           
            //coloca no label o prazo em dias original
            document.getElementById("label_dias_novo_prazo").innerHTML = <?php echo e($solicitacao->servico->prazo); ?> + " dias";   

         }else{
              swal(
               'Atenção',
               'A solicitacao já está Em execução',
               'warning'
            );
         }

        
      });


      
      $("#btn_por_execucao_salvar").click(function(){
         event.preventDefault();
         event.stopPropagation();

         DAY = 1000 * 60 * 60  * 24
         
         let data_criacao_solicitacao   = new Date('<?php echo date($solicitacao->created_at); ?>').setHours(0,0,0,0);
         let data_picker = $( "#picker_data_prazo" ).datepicker( "getDate" ).setHours(0,0,0,0);
         let prazo   = new Date(data_picker);
         let hoje    = new Date();
         hoje.setHours(0,0,0,0);
         
         let dias_novo_prazo  = Math.round(((prazo - data_criacao_solicitacao) / DAY)) ;
         let dias_velho_prazo = <?php echo e($prazo_em_dias); ?>;




         //testa se a data do novo prazo é anterior a data de hoje
         if (prazo < hoje) 
         {

            swal(
               'Atenção',
               'A data do novo prazo não pode ser anterior a hoje',
               'error'
            ).then(function () {
              $( "#picker_data_prazo" ).focus();
           });

         }else{

            /*AJAX*/

            // pega o Prazo original da solicitação
            let p = new Date('<?php echo e(substr($prazo_calculado, 4, 2)); ?>/<?php echo e(substr($prazo_calculado, 6, 2)); ?>/<?php echo e(substr($prazo_calculado, 0, 4)); ?>');
            let prazo_original = moment(p).format("L");

            //coloca o prazo original da solicitação nopicker
            let prazo_atual = moment($( "#picker_data_prazo" ).datepicker( "getDate" ).setHours(0,0,0,0)).format("L"); 

            console.log(prazo_original);
            console.log(prazo_atual);
            console.log(dias_novo_prazo);


            
            //verifica se o prazo foi alterado
            if( prazo_original == prazo_atual)
            {
               
               //AJAX COM MUDANÇA DE STATUS  
               $.post('/solicitacao/<?php echo e($solicitacao->id); ?>', {
                  _token : '<?php echo e(csrf_token()); ?>',
                  _method: 'PUT',
                  campo_alterado:  'status',
                  valor_antigo:    '<?php echo e($solicitacao->status); ?>',
                  andamento:       'Alterou',
                  motivo:          'Colocou em execução',
                  acao:             5

               }, function(res){
                  let resposta = JSON.parse(res);

                  //envia comentario na solicitação sobre a mudança de status
                  comentarioAutomatico(<?php echo e($solicitacao->id); ?>, <?php echo e($funcionario_logado->id); ?>, "A Solicitação foi colocada \"Em execução\" o prazo para a conclusão é dia: " .prazo_atual);
           
               });


               $("#div_por_em_execucao").css('display', 'none'); 
               $("#div_botoes_iniciais").css('display', 'block'); 
               $("#div_escrever_comentario").show();
               $("#div_botoes_da_execucao").css('display', 'none'); 
            }else{

               if (  $("#select_prazo_motivo").val() == ''  ){
                  demo.notificationRight("top", "right", "rose", "Selceiono um Motivo");     
                  demo.initFormExtendedDatetimepickers();
               }else{

                  //AJAX COM MUDANÇA DE STATUS  E PRAZO
                  $.post('/solicitacao/<?php echo e($solicitacao->id); ?>', {
                     _token :                '<?php echo e(csrf_token()); ?>',
                     _method:                'PUT',

                     //campos do status
                     campo_alterado_status:  'status',
                     valor_antigo_status:    '<?php echo e($solicitacao->status); ?>',
                     andamento_status:       'Alterou',
                     motivo_status:          'Colocou em execução',

                     //campos do prazo
                     campo_alterado_prazo:   'prazo',
                     valor_antigo_prazo:     <?php echo e($prazo_em_dias); ?>,
                     andamento_prazo:        'Alterou',
                     motivo_prazo:           $("#select_prazo_motivo option:selected").html(),

                     //campos da solicitação
                     prazo:                  dias_novo_prazo,
                     status:                 "Em execução",
                     acao:                   6

                  }, function(res){
                     let resposta = JSON.parse(res);
                  });

                  //envia comentario na solicitação sobre a mudança de status
                  comentarioAutomatico(<?php echo e($solicitacao->id); ?>, <?php echo e($funcionario_logado->id); ?>, "A Solicitação foi colocada EM EXECUÇÃO e o prazo para a conclusão é dia: " +prazo_atual);

                  $("#div_por_em_execucao").css('display', 'none'); 
                  $("#div_botoes_iniciais").css('display', 'block'); 
                  $("#div_escrever_comentario").show();
                  $("#div_botoes_da_execucao").css('display', 'none'); 
               }
            }

            //coloca no label o novo prazo 

            console.log(moment(hoje).format("L"));
            console.log(prazo_atual);
            document.getElementById("span_prazo").innerHTML = prazo_atual;   

            if( moment(hoje).format("L") == prazo_atual)
            {
               document.getElementById("span_prazo").style.backgroundColor  = "orange";
            }else{
               document.getElementById("span_prazo").style.backgroundColor  = "green";               
            }
            
            //altera o span com o status
            document.getElementById("span_satus").innerHTML = "Em execução";   
            document.getElementById("span_satus").classList.remove('status-aberta');
            document.getElementById("span_satus").classList.remove('status-analise');
            document.getElementById("span_satus").classList.add('status-execucao');

         }
      });


      
      $(".cancela-execucao").click(function(){
         event.preventDefault();

         $("#div_por_em_execucao").css('display', 'none'); 
         $("#div_botoes_iniciais").css('display', 'block'); 
         $("#div_escrever_comentario").show();
         $("#div_botoes_da_execucao").css('display', 'none'); 
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
                     $("#div_botoes_iniciais").css('display', 'block'); 
                     
                     $("#servico-edicao").css('display', 'none');             
                     $("#botao-servico").css('display', 'none');  

                     // Levantamento de peso

                     $.post('/solicitacao/<?php echo e($solicitacao->id); ?>', {
                        _token :    '<?php echo e(csrf_token()); ?>',
                        _method:    'PUT',
                        servico_id: id_servico,
                        acao:       3
                     }, function(res){
                        let resposta = JSON.parse(res);

                        $("#servico-texto").html(  resposta.sigla +' - ' + 
                           resposta.servico +' - ' +
                           resposta.setor );

                        $("#setor-icone").removeClass().addClass('mdi '+ resposta.icone);
                        $("#setor-cor").css('background-color', resposta.cor + " !important");


                        console.log("Resposta", resposta);
                     });
                  });
               })
         };
      });


      
      
      
      

      

      $("#btn_redirecionar_solicitacao").click(function(){
         event.preventDefault();
         $("#servico").css('display', 'none');
         $("#div_botoes_iniciais").css('display', 'none');
         $("#div_escrever_comentario").hide();
         

         $("#servico-edicao").css('display', 'block'); 
         $("#botao-servico").css('display', 'block'); 
      });


      
      
      
      

      

      $("#btn_solucionar_solicitacao").click(function(){
         event.preventDefault();
         let hoje    = new Date();
         hoje        = moment(hoje).format("L");
         

         $("#servico").css('display', 'none');

         //cria uma frase padrão
         let comentario_padrao = 'A solicitação foi solucionada em: ' + String(hoje);

         swal({
            title:                  'Solucionar a solicitação',
            input:                  'textarea',
            inputValue:             comentario_padrao,
            inputPlaceholder:       'Selecione um motivo',
            type:                   'question',
            showCancelButton:       true,
            confirmButtonColor:     '#3085d6',
            cancelButtonColor:      '#d33',
            confirmButtonText:      'Solucionar',
            cancelButtonText:       'Não',
            showLoaderOnConfirm:    true,

            inputValidator: function (value) {
               return new Promise(function (resolve, reject) {
                  //testa se o operador deixou em branco o campo para digitar o comentario final
                  if (value != false) {
                     resolve()
                  } else {
                     //se estiver vazio pega o comentario padrão
                     inputValue = comentario_padrao;
                     console.log(inputValue);
                     resolve()
                     //reject('Escreva um comentário final para a Solução dessa solicitação')

                  }
               })
            }
         }).then(function (result) {
               swal(
                  'Solicitação solucionada!',
                  '',
                  'success'
                  ).then(function(){
                     $.post('/solicitacao/<?php echo e($solicitacao->id); ?>', {
                        _token:           '<?php echo e(csrf_token()); ?>',
                        _method:          'PUT',

                        status:           'Solucionada',
                        valor_antigo:     '<?php echo e($solicitacao->status); ?>',
                        
                        acao:             7
                     }, function(resposta){
                        //envia comentario na solicitação sobre SOLUÇÂO da solicitação
                        comentarioAutomatico(<?php echo e($solicitacao->id); ?>, <?php echo e($funcionario_logado->id); ?>, result);
                        console.log(resposta);
                        window.location.href="<?php echo e(url("/")); ?>";
                     });
                  });
               })


















      });

      
      $(".cancela-servico").click(function(){
         event.preventDefault();

         $("#servico").css('display', 'block'); 
         $("#div_botoes_iniciais").css('display', 'block'); 
         $("#div_escrever_comentario").show();

         $("#servico-edicao").css('display', 'none'); 
         $("#botao-servico").css('display', 'none'); 
         
      });

      
      
      
      
      

      

      $("#btn_recusar_solicitacao").click(function(){
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


      
      
      
      

      
      $("#enviar-comentario").click(function(e){
            e.preventDefault();
            // Chamar a função que faz a chamada Ajax
            enviarComentario(this, e);
            
            //verifica se a solicitação está com o status igual a ABERTA
            // se sim altera para 'Em Análise' pois algum funcionario comeceçou a interagir
         
            if( '<?php echo e($solicitacao->status); ?>' == 'Aberta' )
            {
               console.log("enviou para o /status");
               $.post(
                     url_base+"/status",
                     {
                        status:           'Em análise',
                        solicitacao_id:   <?php echo e($solicitacao->id); ?>, 
                        _token: token,
                     });
            };   
         
      });
   </script>



   
   
   
   


   <script type="text/javascript">

      //configura o datepicker que recebe a data do NOVO PRAZO para ser alterado 
      //LOCAL: edit-funcionario.blade.php->botão "execucao" - (POR EM EXECUÇÃO)
      $( function() {
         $( "#picker_data_prazo" ).datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior',

            showOtherMonths: true,
            showAnim: "slideDown",

            // minDate: 0,
            // showButtonPanel: true,
         })
         .change(dateChanged)
         .on('changeDate', dateChanged);
      });


      function dateChanged(ev) {
         $(this).datepicker('hide');

         DAY = 1000 * 60 * 60  * 24
         
         let data_criacao_solicitacao   = new Date('<?php echo date($solicitacao->created_at); ?>').setHours(0,0,0,0);
         
         let data_picker = $( "#picker_data_prazo" ).datepicker( "getDate" ).setHours(0,0,0,0);

         let prazo   = new Date(data_picker);
         let hoje    = new Date();
         hoje.setHours(0,0,0,0);
         let dias_novo_prazo  = Math.round(((prazo - data_criacao_solicitacao) / DAY)) ;
         let dias_velho_prazo = <?php echo e($prazo_em_dias); ?>;

         /*console.log(dias_novo_prazo);
         console.log(dias_velho_prazo);*/

         document.getElementById("label_dias_novo_prazo").innerHTML = dias_novo_prazo + " dias";   

         if(dias_velho_prazo == dias_novo_prazo)
         {
            console.log("iga");
            $("#select_prazo_motivo").attr("disabled", "true");            
            //$('#select_prazo_motivo').val("Selecione o motivo para alteração do Prazo");

            //volta o select para o valor inicial
            document.getElementById("select_prazo_motivo").selectedIndex = "0";
         }else{
            console.log("dif");
            $("#select_prazo_motivo").removeAttr("disabled");

         }
        
      }
      //FIM ===================================================================================================
   </script>


   

   <script id="comentario-template" type="text/x-handlebars-template">
      
         <div class="card-secretaria card margin7" style="color: black; font-size: 12px;">
            <div class="row" style="margin-left: 15px;margin-right: 15px;">
               <label class="pull-right" style="color: #522d2d; font-size: 11px;"> 
                  {{ data_criacao }} 
               </label>
               
            
               <label class="h6  nome-solicitante">
                  {{ nome_funcionario }} - 
                  {{ nome_setor }} - 
                  {{ sigla }}
               </label>

            
               <div class="col-coment-fix">
                  <div class=" col-md-7 no-margin" >
                     <p class="">
                        {{ comentario }}
                     </p>
                  </div>
               </div>
            </div>
         </div>

      
   </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.material', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>