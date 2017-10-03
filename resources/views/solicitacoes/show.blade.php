@extends('layouts.material')

@section('titulo')

	Solicitações

@endsection

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

                                    <div class="col-md-6">

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

                                                <div class="card-image" style="width: 60%;">
                                                    
                                                    <a href="#pablo">
                                                        <img class="img" src="{{ asset('img/Buraco.jpeg') }}">
                                                    </a>
                                                </div>
                                                <span class="endereco" onclick="mostraMapa(-22.78582000,-43.42520100,86);" style="color: #000;">
                     
                                                    <i class="material-icons" style="font-size: 20px; margin-top: 5px;">place</i>  

                                                    Rua Batista das Neves 562 - Mesquita - 21088-066 
                                                </span>
                                                <p>Rua Batista das Neves esquina com a rua Abel de Alvarenga.</p>
                                            </div>

                                        </div>

                                        {{-- Informãções --}}

                                        <div class="row"></div>

                                        {{-- Opções --}}

                                        <div class="row"></div>

                                    </div>

                                    {{-- Lado Direito --}}

                                    <div class="col-md-6 scroll-comentarios">

                                        {{-------------------------- Comentario do solicitante --------------------------}}

                                        <div class="card margin10">

                                            {{-- Avatar pequeno --}}
                                            <div class="card-header card-header-icon avatar-fixo-pn">
                                                <img class="img" src="{{ asset('img/Ronald.jpg')}}"/>
                                            </div>

                                            

                                            {{-- Comentário --}}
                                            <form class="form-horizontal">

                                               {{-- Nome do usuário --}}
                                                <label class="col-md-8 h6 nome-solicitante">
                                                    Ronald
                                                </label>

                                                {{-- Comentário Fixo --}}
                                                <div class="coment-fix">
                                                    <div class="form-group col-md-12 no-margin">
                                                        <p class="form-control-static">Esse Buraco já tem mais de 3 meses</p>
                                                    </div>
                                                    <div style="clear:both"></div>
                                                </div>
                                            </form> 
                                        </div>{{-- Fim Comentário --}}

                                        {{-------------------------- Comentario do funcionário --------------------}}
                                        
                                        <div class="card margin10">

                                            {{-- Avatar pequeno --}}
                                            <div class="card-header card-header-icon avatar-fixo-pn pull-right">
                                               <img class="img" src="{{ asset('img/brasao.png')}}"/>
                                            </div>

                                            {{-- Comentário --}}
                                            <form class="form-horizontal card-secretaria">
                                               <div class="row">

                                                  {{-- Nome da secretária --}}
                                                  <label class="h6 pull-right fc-rtl nome-secretaria">
                                                     Secretaria Municipal de Obras - 
                                                     SEMOSPDEC
                                                  </label>
                                                  {{-- Comentário --}}
                                                  <div class="col- fc-rtl">
                                                     <div class="form-group col-md-12 pull-right no-margin">
                                                        <p class="form-control-static">
                                                           Obrigado pela Informação.
                                                        </p>
                                                     </div>
                                                  </div>
                                               </div>
                                            </form> 
                                        </div>{{-- Fim Comentário --}}

                                    </div>  

                                </div>

                                {{-- Rodapé do cartão--}}
                                <div class="row">
                                    {{-- Linha de Baixo --}}

                                    <div class="col-md-6">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="dropdown">
                                                <button href="#pablo" class="dropdown-toggle btn btn-primary btn-round btn-block" data-toggle="dropdown" aria-expanded="false">Selecione uma Ação
                                                    <b class="caret"></b>
                                                <div class="ripple-container"></div></button>
                                                <ul class="dropdown-menu dropdown-menu-left">
                                                    <li class="dropdown-header">Dropdown header</li>
                                                    <li>
                                                        <a href="#pablo">Action</a>
                                                    </li>
                                                    <li>
                                                        <a href="#pablo">Another action</a>
                                                    </li>
                                                    <li>
                                                        <a href="#pablo">Something else here</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="#pablo">Separated link</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a href="#pablo">One more separated link</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary btn-round">enviar<div class="ripple-container"><div class="ripple ripple-on" style="left: 51.2656px; top: 31px;"></div></div></button>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- Campo responder --}}
                                        <div class="col-md-12">

                                            <div class="form-group label-floating is-empty col-md-9">
                                                <label class="control-label"></label>
                                                <input type="text" class="form-control" placeholder="Responder">
                                            <span class="material-input"></span></div>

                                            <div class="form-group col-md-3">
                                                 <button class="btn btn-primary btn-xs">
                                                    <i class="material-icons">send</i>
                                                    Enviar
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </div>
                                            <div style="clear:both"></div>
                                        </div>
                                        {{-- Fim do campo responder --}}
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