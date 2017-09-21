@extends('layouts.material')

@section('titulo')

   Moderar Solicitação

@endsection

@section('content')

   <div class="container-fluid cartao-principal">

      {{-- O cartão começa aqui --}}
      <div class="col-md-12  card " style="padding: 30px;">

         {{-- Topo do cartão--}}
         <div class="row col-md-8">
            <div class="card-header card-header-icon avatar-fixo">
               <img class="img" src="{{ $solicitacao->solicitante->foto }}"/>
            </div>

            <div class="card-header card-header-icon avatar-status pull-right" 
               data-background-color style="background-color: {{ $solicitacao->servico->setor->cor }};">
               {{-- <i class="material-icons">language</i> --}}
               <span class="mdi {{ $solicitacao->servico->setor->icone }}" style="font-size: 30px"></span>
            </div>

            <div class="nome-solicitante-card ">{{ $solicitacao->solicitante->nome}}</div>
            <div class="data-inclusao-card ">Adicionado {{ $solicitacao->created_at->diffForHumans()}}</div>

            
            {{-- Foto da publicação --}}
            <div class="card-image">
               <span class="label label-danger"></span>
               <a href="#">
                  <img class="img" src="{{ $solicitacao->foto }}" >
               </a>
            </div>
            
            {{ $solicitacao->conteudo }}
            
               
         
         </div>
      </div>
   </div>

                                    

 @endsection