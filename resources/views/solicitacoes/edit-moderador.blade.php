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

                           <div>
                              {{ $solicitacao->conteudo }}
                           </div>

                        </div>

                     </div> {{-- Fim da Primeira Linha --}}

                     <div id="LocalMapa_{{ $solicitacao->id }}" class=" row mapa"></div>
                           


                     <div class="row">

                        {{-- Linha de Botões --}}
                        
                        <div style="text-align:center">
                           
                           <button class="botoes-acao btn btn-round btn-success libera-solicitacao">
                              <span class="icone-botoes-acao mdi mdi-send"></span>
                              <span sclass="texto-botoes-acao"> Liberar </span>
                           </button>

                           <button class="botoes-acao btn btn-round" style="background: #1d1617;">
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
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


@endsection

@push('scripts')
   <script src="{{ asset('lightbox2/dist/js/lightbox.min.js') }}"></script>

   <script>
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
            {{ url('/modera/datatables/0') }}
           swal(
             'Solicitação liberada!',
             '',
             'success'
           )
         })
      });

      $(".recusa-solicitacao").click(function(){
         event.preventDefault();
      
         swal({
           title: 'Submit email to run ajax request',
           input: 'textarea',
           showCancelButton: true,
           confirmButtonText: 'Submit',
           showLoaderOnConfirm: true,
           preConfirm: function (email) {
             return new Promise(function (resolve, reject) {
               setTimeout(function() {
                 if (email === 'taken@example.com') {
                   reject('This email is already taken.')
                 } else {
                   resolve()
                 }
               }, 2000)
             })
           },
           allowOutsideClick: false
         }).then(function (email) {
           swal({
             type: 'success',
             title: 'Ajax request finished!',
             html: 'Submitted email: ' + email
           })
         })      
      });

   </script>
@endpush