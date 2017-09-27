@extends('layouts.material')

@section('titulo')

Solicitações

@endsection

@push('css')
<link href="{{ asset('lightbox2/dist/css/lightbox.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-plain">
            <div class="card-content">
               {{-- O cartão começa aqui --}}
               <div class="col-md-12 gesol-panel card card-product" style="padding: 35px;">
                  {{-- Topo do cartão--}}
                  <div class="row">
                     {{-- Lado Esquerdo --}}
                     <div class="col-md-6 ">
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
                              .'('. $solicitacao->created_at->format('h:m - j/m/Y').')'}}  
                           </div>

                           <div class="row">
                              <div class="timeline-body">
                                 <div class="card-header icon-secretaria avatar-status pull-right" data-background-color="purple">

                                    <span class="material-icons" style="font-size: 30px">build</span>
                                 </div>

                                 <div data-lightbox="foto-solicitacao"  class="card-image" style="width: 75%; margin-left: 36px; top:-34px;">
                                    <a href="{{ $solicitacao->foto }}">
                                       <img class="img" src="{{ $solicitacao->foto }}">
                                    </a>
                                 </div>
                              </div>

                           </div>

                        </div>

                        {{-- Lado Direito --}}

                        <div class="col-md-6">

                           <h4>Endereço</h4>

                           <span class="endereco" 
                           onclick="mostraMapa({{ $solicitacao->endereco->latitude }},{{ $solicitacao->endereco->longitude }},{{ $solicitacao->id }});">
                           <i class="material-icons" style="font-size: 20px; margin-top: 5px;">place</i>  

                           {{ $solicitacao->endereco->logradouro }} 
                           {{ $solicitacao->endereco->numero }} -
                           {{ $solicitacao->endereco->bairro }} -
                           {{ $solicitacao->endereco->cep }} 
                        </span>

                        <br><br>
                        <div id="linha"></div>
                        <h4>Conteúdo</h4>

                        <div id="conteudo">
                           {{ $solicitacao->conteudo }}
                        </div>

                        <div id="conteudo-edicao" style="visibility: hidden">
                           <textarea id="textarea-edicao" rows="5" cols="60" name="conteudo">{!! $solicitacao->conteudo !!}</textarea>
                        </div>

                     </div>
                  </div> {{-- Fim da Primeira Linha --}}

                  <div id="LocalMapa_{{ $solicitacao->id }}" class=" row mapa"></div>



                  <div class="row">

                     {{-- Linha de Botões --}}
                     {{-------------------------- BOTAO PADRAO ------------------------}}
                     <div id="botao-padrao" style="text-align:center">
                        <button class="botoes-acao btn btn-round btn-success libera-solicitacao">
                           <span class="icone-botoes-acao mdi mdi-send"></span>
                           <span sclass="texto-botoes-acao"> Liberar </span>
                        </button>

                        <button style="background: #1d1617;" class="botoes-acao btn btn-round edita-solicitacao" >
                           <span class="icone-botoes-acao mdi mdi-comment-remove-outline"></span>
                           <span sclass="texto-botoes-acao">  Editar </span>
                        </button>

                        <button class="botoes-acao btn btn-round btn-warning">
                           <span class="icone-botoes-acao mdi mdi-redo-variant"></span>
                           <span sclass="texto-botoes-acao"> Redirecionar </span>
                        </button>

                        <button class="botoes-acao btn btn-round btn-danger recusa-solicitacao">
                           <span class="icone-botoes-acao mdi mdi-delete-sweep"></span>
                           <span sclass="texto-botoes-acao"> Recusar </span>
                        </button>

                        <button class="botoes-acao btn btn-round btn-primary">
                           <span class="icone-botoes-acao mdi mdi-backburger"></span>   
                           <span sclass="texto-botoes-acao"> Voltar </span>
                        </button>
                     </div>

                     {{-------------------------- BOTAO CONTEUDO ------------------------}}
                     <div id="botao-conteudo" style="text-align:center; visibility: hidden">
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
                           <span sclass="texto-botoes-acao"> Voltar </span>
                        </button>
                     </div>
                  </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<form action="{{ url("/modera") }}" method="POST" id="form-hidden" style="visibility: hidden">
  {{ csrf_field() }}
  <input type="hidden" value="{{ $solicitacao->id }}" name="solicitacao_id">
  <input type="hidden" value="" name="acao" id="hidden_acao">
</form>

@endsection

@push('scripts')
<script src="{{ asset('lightbox2/dist/js/lightbox.min.js') }}"></script>

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
      $("#conteudo-edicao").css('visibility', 'visible'); 
      $("#botao-padrao").hide();
      $("#botao-conteudo").css('visibility', 'visible'); 
  });

   $(".cancela-conteudo").click(function(){
      event.preventDefault();

      $("#conteudo").show(); 
      $("#conteudo-edicao").css('visibility', 'hidden'); 
      $("#botao-padrao").show();
      $("#botao-conteudo").css('visibility', 'hidden'); 
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

            let conteudo = $("#conteudo-edicao textarea").val();

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
               conteudo: conteudo
            }, function(resposta){
               console.log(resposta);
            });
         });
      })
   });

    $(".impropria").click(function(){
      event.preventDefault();

      trocaTexto("textarea-edicao", "<span style='color: red;'> [EDITADO - palavra imprópria] </span>");
      
   });
   
   
   /*================================ EDITAR =========================================*/






</script>
@endpush