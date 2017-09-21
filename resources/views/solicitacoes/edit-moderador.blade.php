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
                  <ul class="timeline">
                     <li class="timeline-inverted">
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
                                 
                                 <button class="botoes-acao btn btn-round btn-success">
                                    <span class="mdi mdi-send"></span>
                                    Liberar
                                 </button>
                                 
                                 <button class="botoes-acao btn btn-round btn-danger">
                                    <span class="mdi mdi-close"></span>
                                    Recusar
                                 </button>
                                 
                                 <button class="botoes-acao btn btn-round btn-warning">
                                    <span class="mdi mdi-redo-variant"></span>
                                    Redirecionar
                                 </button>
                                    
                                 <button class="botoes-acao btn btn-round btn-primary">
                                    <span class="mdi mdi-backburger"></span>   
                                    Voltar
                                 </button>

                              </div>

                           </div>

                        </div>
                     </li>
                  </ul>            
               </div>
            </div>
         </div>
      </div>
</div>

@endsection

@push('scripts')
   <script src="{{ asset('lightbox2/dist/js/lightbox.min.js') }}"></script>
@endpush