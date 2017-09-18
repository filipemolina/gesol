@extends('layouts.material')

@section('titulo')

	Editar Solicitação

@endsection

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-8" style="left: 15%;">
            <div class="card card-plain">
                <div class="card-content">
                    <ul class="timeline">
                        <li class="timeline-inverted">

                            {{-- O cartão começa aqui --}}
                                
                            <div class="col-md-12 gesol-panel card card-product" style="padding: 35px;">

                                {{-- Topo do cartão--}}

                                <div class="row">
                                    
                                    {{-- Lado Esquerdo --}}

                                    <div class="col-md-12">

                                        {{-- Avatar pequeno --}}
                                        <div class="card-header card-header-icon avatar-fixo-pn foto-user">
                                            <img class="img" src="{{ asset('img/Ronald.jpg')}}"/>
                                        </div>
                                        <label class="col-md-8 h6 nome-solicitante">
                                            Ronald
                                        </label><br>
                                            
                                        <div class="row">
                                            
                                            <div class="timeline-body">

                                                <div class="form-group">
                                                    <label class="label-control">Criado em:</label>
                                                    <input type="text" class="form-control datetimepicker" value="10/05/2016"/ disabled="true">
                                                </div>

                                                <div class="card-header icon-secretaria avatar-status pull-right" data-background-color="purple">
                  
                                            <span class="material-icons" style="font-size: 30px">build</span>
                                            </div>

                                                <div class="card-image" style="width: 60%; margin-left: 112px;">
                                                    
                                                    <a href="#pablo">
                                                        <img class="img" src="{{ asset('img/Buraco.jpeg') }}">
                                                    </a>
                                                </div>
                                            <div class="input-group col-md-8" style="margin-left: 88px;">
                                                
                                                <div class="form-group label-floating has-roxo col-md-10">
                                                    <label class="control-label">Logradouro</label>
                                                    <input id="rua" name="endereco[logradouro]" type="text" class="form-control error" 
                                                    value="{{-- {{ $solicitante->endereco->logradouro or old('endereco.logradouro') }} --}}">
                                                </div>
                                                
                                                <div class="form-group label-floating has-roxo col-md-2">
                                                    <label class="control-label">Numero</label>
                                                    <input id="numero" name="endereco[numero]" type="text" class="form-control error" 
                                                    value="{{-- {{ $solicitante->endereco->numero or old('endereco.numero') }} --}}">
                                                </div>

                                                <div class="form-group label-floating has-roxo col-md-10">
                                                    <label class="control-label">Municipio</label>
                                                    <input id="cidade" name="endereco[municipio]"  type="text" class="form-control error" 
                                                    value="{{-- {{ $solicitante->endereco->municipio or old('endereco.municipio') }} --}}">
                                                </div>

                                                <div class="form-group label-floating has-roxo col-md-2">
                                                    <label class="control-label">Bairro</label>
                                                    <input id="bairro" name="endereco[bairro]" type="text" class="form-control error"  
                                                    value="{{-- {{ $solicitante->endereco->bairro or  old('endereco.bairro') }} --}}">
                                                </div>

                                                <div class="form-group label-floating has-roxo col-md-8">
                                                    <label class="control-label">CEP</label>
                                                    <input id="cep" name="endereco[cep]" type="text" class="form-control error" 
                                                    value="{{-- {{ $solicitante->endereco->cep or old('endereco.cep') }} --}}">
                                                </div>

                                                    
                                                <div class="form-group label-floating has-roxo col-md-4">
                                                    <label class="control-label">UF</label>
                                                    <select   name="endereco[uf]" id="uf"  class="form-control form-control error">
                                                        <option value=""  selected style="color: #ccc;">  </option>

                                                        {{-- @foreach($ufs as $uf)
                                                            @if ( $solicitante->endereco->uf == $uf)
                                                                <option value="{{$uf}}" selected="selected">{{$uf}}</option>
                                                            @else
                                                                <option value="{{$uf}}">{{$uf}}</option>  
                                                            @endif
                                                        @endforeach --}}
                                                    </select>
                                                </div>


                                            </div>

                                                <form action="#">

                                                    <div class="form-group">
                                                        <label></label>
                                                        <textarea name="" id="" class="col-md-8" rows="5" style="margin-left: 88px;"></textarea>
                                                        
                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                        {{-- Informãções --}}

                                        <div class="row"></div>

                                        {{-- Opções --}}

                                        <div class="row"></div>

                                    </div>

                                    
                                </div>

                                {{-- Rodapé do cartão--}}
                                <div class="row">
                                    {{-- Linha de Baixo --}}

                                    <div class="col-md-12">
                                        <div class="col-lg-6 col-md-6 col-sm-6" style="margin-left: 37%;">
                                            
                                            <button class="btn btn-primary btn-round">enviar<div class="ripple-container"><div class="ripple ripple-on" style=" top: 31px;"></div></div></button>

                                        </div>
                                        
                                    </div>
                                    
                                </div>

                                                                        
                            </div> {{-- Fim do Cartão --}}
    

                        </li>
                    </ul>            
                </div>
                                       
            </div>
        </div>
        
    </div>
    
</div>

@endsection