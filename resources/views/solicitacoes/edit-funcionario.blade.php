@extends('layouts.material')

@section('titulo')

Solicitações

@endsection

@push('css')
   <link href="{{ asset('lightbox2/dist/css/lightbox.min.css') }}" rel="stylesheet" />
@endpush

@section('content')


<div class="row">
   <div class="col-md-12">
      {{-- O cartão começa aqui --}}
      <div class="col-md-12 gesol-panel card card-product" style="padding: 35px;margin-top: 15px;">
         {{-- Topo do cartão--}}
         <div class="row">
            {{-- Lado Esquerdo --}}
            <div class="col-md-5" style="padding-right: 0px;padding-left: 0px;">
               {{-- Avatar pequeno --}}
               <div>
                  <div class="card-header card-header-icon avatar-fixo-pn foto-user">
                     <img class="img" src="{{ $solicitacao->solicitante->foto }}"/>
                  </div>
               </div>

               <div class="nome-solicitante-card info-solictante" style="margin-top: -17px;">
                  {{ $solicitacao->solicitante->nome}}
               </div>

               <div class="data-inclusao-card info-solictante">

                  Abertura: {{ $solicitacao->created_at->format('H:i:s - d/m/Y')}}    
                  <br>
                  Prazo: 

                     @if(date('Ymd') > date('Ymd', strtotime($prazo_calculado)) )
                        
                        <span class='badge' style='background-color:red'>     
                        
                     @elseif( date('Ymd') == date('Ymd', strtotime($prazo_calculado)) )

                        <span class='badge' style='background-color:orange'>     
                     @else
                        <span class='badge' style='background-color:green'>     

                     @endif

                     {{ date('d/m/Y', strtotime($prazo_calculado)) }}  
                  </span>

                  --- Status: 
                  <!-- <span class='badge' style='background-color:red'>  -->
                  
                  @if($solicitacao->status =='Aberta')

                     <span class='badge status-aberta'> {!! $solicitacao->status !!} </span>  

                  @elseif($solicitacao->status =='Em análise')

                        <span class='badge status-analise'> {!! $solicitacao->status !!} </span>  

                  @endif






               </div>

               <div class="row">
                  <div class="timeline-body">
                     <div id="setor-cor" class="card-header card-header-icon icon-secretaria avatar-status pull-right" data-background-color 
                        style="background-color: {{ $solicitacao->servico->setor->cor }}; left: 40px">
                        <span id="setor-icone" class="mdi {{ $solicitacao->servico->setor->icone }}" style="font-size: 30px">build</span>
                     </div>

                     <div data-lightbox="foto-solicitacao"  class="card-image" style="width: 85%; margin-left: 36px; top:-30px;">
                        <a href="{{ $solicitacao->foto }}">
                           <img class="img" src="{{ $solicitacao->foto }}">
                        </a>
                     </div>

                     <div class="endereco" style="margin-left:36px; margin-top: -26px;"
                        onclick="mostraMapa({{ $solicitacao->endereco->latitude }},{{ $solicitacao->endereco->longitude }},{{ $solicitacao->id }});">
                        <i class="material-icons" style="font-size: 20px; ">place</i>  

                        {{ $solicitacao->endereco->logradouro }} 
                        {{ $solicitacao->endereco->numero }} -
                        {{ $solicitacao->endereco->bairro }} -
                        {{ $solicitacao->endereco->cep }} 
                     </div>
                  </div>
               </div>
            </div>

            {{-- Lado Direito --}}

            <div class="col-md-7" style="padding-left: 0px; padding-right: 0px;">

               <div id="servico">
                  <h4 style="margin-bottom: 0px; margin-top: 0px;"> Destino da Solicitação: </h4>
                  <div id="servico-texto">
                     {{ $solicitacao->servico->setor->secretaria->sigla }} - 
                     {{ $solicitacao->servico->setor->nome }} - 
                     {{ $solicitacao->servico->nome }}       
                  </div>    
               </div>

               <div id="servico-edicao" style="display: none;">
                  <h4> Redirecionar solicitação </h4>    
                  {{-- Categoria selecionada --}}

                  <div class="label-floating " style="border-style: dotted; padding: 6px;">
                     {{-- novo destino --}}
                     <select id="select-servico" class="js-example-data-array" data-live-search="true" > 
                        <option value="" selected>Selecione novo destino</option>
                        @foreach($setores as $setor)
                        <optgroup label="{{ $setor->nome }}">
                           @foreach($setor->servicos as $servico)
                              <option value="{{$servico->id}}">{{$servico->nome}}</option>  
                           @endforeach
                        </optgroup>
                        @endforeach
                     </select>

                     {{-- motivo transferencia --}}
                     <select id="select-servico-motivo" class="js-example-data-array" data-live-search="true" > 
                        <option value="" selected>Selecione uma motivo</option>
                        @foreach($motivos_transferencia as $motivo)
                           <option value="{{$motivo}}">{{$motivo}}</option>  
                        @endforeach
                     </select>

                  </div>
               </div>

               <br>
               <div id="linha"></div>

               {{-- começo das mensagens --}}
               <div class="comentarios scroll-comentarios" id="div-comentarios">

                  @foreach ($solicitacao->comentarios->sortBy('created_at') as $comentario)
                     {{-- card de comentarios --}}
                     <div class="panel-body no-padding comentario_{{ $comentario->id }}" >

                        {{-- Caso a comentario seja do próprio solicitante, mostrar a foto à esquerda --}}
                        @if ($comentario->funcionario)                    
                           {{-- comentario do funcionário --}}
                           <div class="card-secretaria card margin7" style="color: black; font-size: 12px;">
                              <div class="row" style="margin-left: 15px;margin-right: 15px;">
                                 <label class="pull-right" style="color: #522d2d; font-size: 11px;"> 
                                    {{ $comentario->created_at->format('H:i:s -- d/m/Y')}} 
                                 </label>
                                 
                                 {{-- Nome da secretaria --}}
                                 <label class="h6  nome-solicitante">
                                    {{ $comentario->funcionario->nome }} - 
                                    {{ $comentario->funcionario->setor->nome }} - 
                                    {{ $comentario->funcionario->setor->secretaria->sigla }}
                                 </label>

                                 {{-- Comentário --}}
                                 <div class="col-coment-fix">
                                    <div class=" col-md-7 no-margin" >
                                       <p class="">
                                          {{ $comentario->comentario }}
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div> {{-- Fim Comentário --}}
                        @else
                           {{-- comentario do solicitante --}}
                           <div class="card-solicitante margin7" style="color: black; font-size: 12px;">
                              <div class="row" style="margin-left: 15px;margin-right: 15px;">
                                 <label class="pull-right" style="color: #522d2d; font-size: 11px;"> 
                                    {{ $comentario->created_at->format('h:m:s - j/m/Y')}} 
                                 </label>

                                 {{-- Nome do usuário --}}
                                 <label class="h6 nome-solicitante">
                                    {{ $solicitacao->solicitante->nome}}
                                 </label>

                                 {{-- Comentário Fixo --}}
                                 <div class="col-coment-fix" >
                                    <div class=" col-md-7 no-margin" >
                                       <p>{{ $comentario->comentario }}</p>
                                    </div>
                                 </div>
                              </div>
                           
                           </div>
                        @endif
                     {{-- </div> fim card em panel-body --}}
                     </div> {{-- fim panel-body --}}
                     {{-- fim do card de comentarios --}}
                  @endforeach
               </div>

               {{-- Escrever comentário --}}
               <div class="input-group div-escreve-comentario" >
                  <textarea 
                        data-solicitacao="{{$solicitacao->id }}" 
                        data-funcionario="{{$funcionario->id }}" 
                        id="comentario" 
                        name="comentario" 
                        class="form-control comentario comentario_{{ $solicitacao->id }}" 
                        placeholder="Escreva um comentário" 
                        style="margin-top: 0px;padding-bottom: 0px;padding-top: 0px;">

                  </textarea>
                  <span class="input-group-addon">
                     <button type="button" 
                           id="enviar-comentario"
                           data-solicitacao="{{$solicitacao->id }}" 
                           data-funcionario="{{$funcionario->id }}" 
                           class="btn btn-primary btn-sm enviar-comentario">
                        Enviar
                     </button>
                  </span>
               </div>
               {{-- Fim escrever comentário --}}
               {{-- termino das mensagens --}}
            </div>
         </div> {{-- Fim da Primeira Linha --}}

         <div class="row">
            <div id="execucao" style="display: none;">
               <h4 style="margin-top: 0px;margin-bottom: 0px;"> Pôr em execução </h4>    

               <div class="label-floating " style="border-style: dotted; padding: 6px;">
                  
                  <div class="col-md-12">

                     <div class="col-md-4" style="margin-top: 8px;">
                        <span class="prazo-atual" >
                           Prazo Atual:  {{ date('d/m/Y', strtotime($prazo_calculado))  }}  
                           <span class=" mdi mdi-arrow-right-bold"></span> 
                           {{ $solicitacao->servico->prazo }} dias
                        </span>
                     </div>

                     <div class="col-md-4">
                        <span >
                           Novo Prazo: 
                           <input type="text" class="form-control datetimepicker label-floating" 
                              id='datetimepicker1'

                              {{-- verifica se o prazo que já existe é maior ou igual que a data de hoje, 
                                 se sim, significa que o prazo está vencido e a data de hj será o novo prazo, 
                                 senão o prazo permanece --}}

                              @if(date('d/m/Y', strtotime($prazo_calculado)) >= date('d/m/Y') )
                                 value="{{ date('d/m/Y')  }}"   
                              @else
                                 value="{{ date('d/m/Y', strtotime($prazo_calculado))  }}"   
                              @endif
                           /> 
                           <span class=" mdi mdi-arrow-right-bold"></span>
                           
                           <span id="dias"> {{ $solicitacao->servico->prazo }} dias </span>  
                        </span>
                     </div>

                     <div class="col-md-4" style="margin-top: 8px;">
                        <select id="select-prazo-motivo" class="select-prazo-motivo js-example-data-array" data-live-search="true" disabled> 
                           <option value="" selected>Selecione o motivo para alteração do Prazo</option>
                           @foreach($motivos_prazo as $motivo)
                              <option value="{{$motivo}}">{{$motivo}}</option>  
                           @endforeach
                        </select>
                     </div>
                  </div>

                  
                  <div style="clear:both"></div>
               </div>
            </div>        
         </div>             




         <div class="col">
            {{-- Linha de Botões --}}
            {{-------------------------- BOTAO PADRAO ------------------------}}
            <div id="botao-padrao" style="text-align:center; margin-top: -2px;">

               <button class="botoes-acao-funcionario btn btn-round btn-success execucao">
                  <span class="icone-botoes-acao-funcionario mdi mdi-send"></span>
                  Pôr em Execução 
               </button>

               <button class="botoes-acao-funcionario btn btn-round btn-success libera-solicitacao">
                  <span class="icone-botoes-acao-funcionario mdi mdi-send"></span>
                  Solucionar 
               </button>


               <button class="botoes-acao-funcionario btn btn-round btn-warning redireciona-solicitacao">
                  <span class="icone-botoes-acao-funcionario mdi mdi-redo-variant"></span>
                  Redirecionar
               </button>

               <button class="botoes-acao-funcionario btn btn-round btn-danger recusa-solicitacao">
                  <span class="icone-botoes-acao-funcionario mdi mdi-delete-sweep"></span>
                  Recusar
               </button>

               <a class="botoes-acao-funcionario btn btn-round btn-primary" href="{{ URL::previous() }}">
                  <span class="icone-botoes-acao-funcionario mdi mdi-backburger"></span>   
                  Voltar
               </a>
            </div>

            {{-------------------------- BOTAO EXECUCAO ------------------------}}
            <div id="botao-execucao" style="text-align:center; display: none; margin-top: 0px;">
               <button id="botao-execucao-salvar" class="botoes-acao btn btn-round btn-success salva-execucao">
                  <span class="icone-botoes-acao mdi mdi-send"></span>
                  <span class="texto-botoes-acao"> Salvar </span>
               </button>

               <button class="botoes-acao btn btn-round btn-primary cancela-execucao">
                  <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                  <span class="texto-botoes-acao"> Cancelar </span>
               </button>
            </div>

            {{-------------------------- BOTAO SERVICO ------------------------}}
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
         
         <div id="LocalMapa_{{ $solicitacao->id }}" class=" row mapa"></div>
         <form action="{{ url("/modera") }}" method="POST" id="form-hidden" style="visibility: hidden">
           {{ csrf_field() }}
           <input type="hidden" value="{{ $solicitacao->id }}" name="solicitacao_id">
           <input type="hidden" value="" name="acao" id="hidden_acao">
         </form>
      </div>
   </div>
</div>

@endsection

@push('scripts')
   <script src="{{ asset('lightbox2/dist/js/lightbox.min.js') }}"></script>
   <script src="{{ asset("js/handlebars.js") }}" type="text/javascript" charset="utf-8" async defer></script>
   <script src="{{ asset("js/pt-br.js" )}}"></script>

   <script>



      /*================================ EXECUÇÃO =========================================*/
      $(".execucao").click(function(){
         event.preventDefault();
         $("#execucao").css('display', 'block');
         $("#botao-padrao").css('display', 'none');
         $(".div-escreve-comentario").hide();

         $("#execucao-edicao").css('display', 'block'); 
         $("#botao-execucao").css('display', 'block'); 
      });

      $(".cancela-execucao").click(function(){
         event.preventDefault();

         $("#execucao").css('display', 'none'); 
         $("#botao-padrao").css('display', 'block'); 

         $(".div-escreve-comentario").show();
         $(".execucao-edicao").css('display', 'none'); 
         $("#botao-execucao").css('display', 'none'); 
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

                     $.post('/solicitacao/{{ $solicitacao->id }}', {
                        _token :    '{{ csrf_token() }}',
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



      /*================================ REDIRECIONAR =========================================*/
      $(".redireciona-solicitacao").click(function(){
         event.preventDefault();
         $("#servico").css('display', 'none');
         $("#botao-padrao").css('display', 'none');
         $(".div-escreve-comentario").hide();
         

         $("#servico-edicao").css('display', 'block'); 
         $("#botao-servico").css('display', 'block'); 
      });

      $(".cancela-servico").click(function(){
         event.preventDefault();

         $("#servico").css('display', 'block'); 
         $("#botao-padrao").css('display', 'block'); 
         $(".div-escreve-comentario").show();

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
                     $("#div-comentario").css('display', 'block');
                     
                     $("#servico-edicao").css('display', 'none');             
                     $("#botao-servico").css('display', 'none');  

                     // Levantamento de peso

                     $.post('/solicitacao/{{ $solicitacao->id }}', {
                        _token :    '{{ csrf_token() }}',
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

      /*================================ RECUSAR =========================================*/
      $(".recusa-solicitacao").click(function(){
         event.preventDefault();

         swal({
            title: 'Escolha o motivo da recusa',
            input: 'select',
            inputOptions: JSON.parse('{!! json_encode($motivos_recusa) !!}'),

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
                     $.post('/solicitacao/{{ $solicitacao->id }}', {
                        _token : '{{ csrf_token() }}',
                        _method: 'PUT',
                        motivo: result,
                        status: "Recusada",
                        acao:    4
                     }, function(resposta){
                        console.log(resposta);
                        window.location.href="{{ url("/") }}";
                     });
                  });
               })
      });


      /*================================ ENVIAR COMENTARIO  =========================================*/

      $("#enviar-comentario").click(function(e){
            e.preventDefault();
            // Chamar a função que faz a chamada Ajax
            enviarComentario(this, e);
            
            //verifica se a solicitação está com o status igual a ABERTA
            // se sim altera para 'Em Análise' pois algum funcionario comeceçou a interagir
         
            if( '{{ $solicitacao->status }}' == 'Aberta' )
            {
               console.log("enviou para o /status");
               $.post(
                     url_base+"/status",
                     {
                        status:           'Em análise',
                        solicitacao_id:   {{ $solicitacao->id }}, 
                        _token: token,
                     });
            };   
         
      });


      
   </script>
   
   <script id="comentario-template" type="text/x-handlebars-template">
      @verbatim
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

      @endverbatim
   </script>

   <script type="text/javascript">

      $(function () {
         $('#datetimepicker1').datetimepicker({
            locale: 'pt-br',
            format: 'L',
            minDate: new Date(), // = today
            showTodayButton: true,

            tooltips: {
               today: 'Hoje',
               clear: 'Clear selection',
               close: 'Close the picker',
               selectMonth: 'Selecione o mês',
               prevMonth: 'Mês anterior',
               nextMonth: 'Próximo mês',
               selectYear: 'Selecione o ano',
               prevYear: 'Ano anterior',
               nextYear: 'Próximo ano',
               selectDecade: 'Selecione a década',
               prevDecade: 'Década anterior',
               nextDecade: 'Próxima década',
               prevCentury: 'Previous Century',
               nextCentury: 'Next Century',
               incrementHour: 'Increment Hour',
               pickHour: 'Pick Hour',
               decrementHour:'Decrement Hour',
               incrementMinute: 'Increment Minute',
               pickMinute: 'Pick Minute',
               decrementMinute:'Decrement Minute',
               incrementSecond: 'Increment Second',
               pickSecond: 'Pick Second',
               decrementSecond:'Decrement Second',
            },
            

            icons: {
               time: 'glyphicon glyphicon-time',
               date: 'glyphicon glyphicon-calendar',
               up:   'glyphicon glyphicon-chevron-up',
               down: 'glyphicon glyphicon-chevron-down',
               previous: 'glyphicon glyphicon-chevron-left',
               next: 'glyphicon glyphicon-chevron-right',
               today: 'glyphicon glyphicon-screenshot',
               clear: 'glyphicon glyphicon-trash',
               close: 'glyphicon glyphicon-remove'
            },
            

         });

      });

      $("#datetimepicker1").on("dp.change",function (e) {
         
         
         
         DAY = 1000 * 60 * 60  * 24
         
         data_criacao_solicitacao   = '{!! date('d/m/Y',strtotime($solicitacao->created_at)) !!}';
         data_picker                = document.getElementById("datetimepicker1").value;


         var nova1   = data_criacao_solicitacao.toString().split('/');
         Nova1       = nova1[1]+"/"+nova1[0]+"/"+nova1[2];

         var nova2   = data_picker.toString().split('/');
         Nova2       = nova2[1]+"/"+nova2[0]+"/"+nova2[2];

         d1 = new Date(Nova1);
         d2 = new Date(Nova2);

         dias_novo_prazo = Math.round(((d2.getTime() - d1.getTime()) / DAY)) ;

         prazo = data_picker;
         hoje  = Date('d/m/Y') ;



         console.log("data_picker", data_picker);
         console.log("prazo",       prazo);
         console.log("hoje",        hoje);


         console.log("data_picker", Date.parse(data_picker));
         console.log("prazo",       Date.parse(prazo));
         console.log("hoje",        Date.parse(hoje));

         
         //testa se a data do novo prazo é anterior a data de hoje
         /*if (prazo >= hoje) 
         {
            console.log("maior");
            document.getElementById("dias").innerHTML = dias_novo_prazo + " dias";   
            document.getElementById("select-prazo-motivo").disabled = false;
            document.getElementById("botao-execucao-salvar").disabled = false;
         }

         if (prazo < hoje) 
         {
            console.log("menor");
            document.getElementById("select-prazo-motivo").disabled = true;
            document.getElementById("botao-execucao-salvar").disabled = true;
            swal(
               'Atenção',
               'A data do novo prazo não pode ser anterior a hoje',
               'error'
            )
         }*/
         


      });   

 
   </script>

@endpush


