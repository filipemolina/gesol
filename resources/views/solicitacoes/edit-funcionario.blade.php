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
      <div class="col-md-12 gesol-panel card card-product" style="padding: 35px;">
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
                  Adicionado {{ $solicitacao->created_at->diffForHumans() 
                     .' - ' 
                     .'('. $solicitacao->created_at->format('H:i:s -- d/m/Y').')'}}  
                  </div>

                  <div class="row">
                     <div class="timeline-body">
                        <div id="setor-cor" class="card-header card-header-icon icon-secretaria avatar-status pull-right" data-background-color 
                        style="background-color: {{ $solicitacao->servico->setor->cor }};">
                        <span id="setor-icone" class="mdi {{ $solicitacao->servico->setor->icone }}" style="font-size: 30px">build</span>
                     </div>

                     <div data-lightbox="foto-solicitacao"  class="card-image" 
                     style="width: 75%; margin-left: 36px; top:-34px;">
                     <a href="{{ $solicitacao->foto }}">
                        <img class="img" src="{{ $solicitacao->foto }}">
                     </a>
                  </div>

                  <span class="endereco" style="margin-left: 36px;"
                  onclick="mostraMapa({{ $solicitacao->endereco->latitude }},{{ $solicitacao->endereco->longitude }},{{ $solicitacao->id }});">
                  <i class="material-icons" style="font-size: 20px; ">place</i>  

                  {{ $solicitacao->endereco->logradouro }} 
                  {{ $solicitacao->endereco->numero }} -
                  {{ $solicitacao->endereco->bairro }} -
                  {{ $solicitacao->endereco->cep }} 
               </span>
               

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
      <div class="input-group">
         <textarea 
               data-solicitacao="{{$solicitacao->id }}" 
               data-funcionario="{{$funcionario->id }}" 
               id="comentario" 
               name="comentario" 
               class="form-control comentario comentario_{{ $solicitacao->id }}" 
               placeholder="Escreva um comentário" > </textarea>
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

               <div class="col">
                  {{-- Linha de Botões --}}
                  {{-------------------------- BOTAO PADRAO ------------------------}}
                  <div id="botao-padrao" style="text-align:center; margin-top: 20px;">
                     <button class="botoes-acao-funcionario btn btn-round btn-success libera-solicitacao">
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

                  {{-------------------------- BOTAO EDIÇÂO ------------------------}}
                  <div id="botao-conteudo" style="text-align:center; display: none; margin-top: 20px;">
                     <button class="botoes-acao btn btn-round btn-success salva-conteudo">
                        <span class="icone-botoes-acao-funcionario mdi mdi-send"></span>
                        <span class="texto-botoes-acao-funcionario"> Salvar </span>
                     </button>

                     <button class="botoes-acao btn btn-round btn-danger impropria">
                        <span class="icone-botoes-acao mdi mdi-emoticon-poop"></span>   
                        <span class="texto-botoes-acao"> Palavra impropria </span>
                     </button>

                     <button class="botoes-acao btn btn-round btn-primary cancela-conteudo">
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

@endsection

@push('scripts')
   <script src="{{ asset('lightbox2/dist/js/lightbox.min.js') }}"></script>
   <script src="{{ asset("js/handlebars.js") }}" type="text/javascript" charset="utf-8" async defer></script>

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

                  $.post('/solicitacao/{{ $solicitacao->id }}', {
                     _token : '{{ csrf_token() }}',
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
@endpush


