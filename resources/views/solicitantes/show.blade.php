@extends('layouts.material')

@section('titulo')

Visualizar solicitante

@endsection

@section('content')

<div class="row">
	<div class="container">            
      {{-- Dados pessoas --}}
      <div class="col-md-9 col-md-offset-1">
         <div class="card card-singup">
            <form method="get" action="{{-- {{ url("solicitante/$solicitante->id") }} --}}" class="form-horizontal">
               {{-- {!! method_field('PUT') !!}

               {{ csrf_field() }} --}}
               
               {{-- Ícone título --}}
               <div class="card-header card-header-icon card-avatar-fixo pequeno" data-background-color="dourado">
                  <img src="{{-- {{ $solicitacao->solicitante->foto }} --}} {{ asset('img\placeholder.jpg')}}"/>
               </div>

               {{-- Título --}}
               <div class="card-content">
                  <h4 class="card-title no-padding">{{-- {{$solicitante->nome}} --}}Luciano Teles</h4>
               </div>         
               
               <div class="row">
                  
                  {{-- Dados --}}
                  <div class="card-content">
                     
                     {{-- CPF, Email, Nascimento --}}
                     <div class="row">
                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">credit_card</i>
                              </span>
                                     
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">CPF</label>
                                 <label id="cpf" type="text" class="error">{{-- {{ $solicitante->cpf }} --}}114.619.887-64</label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">email</i>
                              </span>
                                     
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Email</label>
                                 <label type="text"> {{-- {{ $solicitante->email}} --}} luciano.junior/@/live.com</label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">event</i>
                              </span>

                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Nascimento</label>
                                 <label type="type" class="datetimepicker error">{{-- {{ $solicitante->nascimento or  old('nascimento') }} --}} 05/05/1986</label>
                              </div>
                           </div>
                        </div>
                     </div> {{-- Fim CPF, Email, Nascimento --}}

                     {{-- Sexo, Escolaridade e CEP --}}
                     <div class="row">                        
                        <div class="col-md-4">
                           <div class="input-group">
                                    <span class="input-group-addon">
                                 <i class="material-icons">wc</i>
                              </span>

                              <div class="control form-group label-floating has-dourado">
                                 <label class="control-label">Sexo</label>
                                 <label class="dourado selectpicker error">Masculino</label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group">
                                    <span class="input-group-addon">
                                 <i class="material-icons">card_membership</i>
                              </span>

                              <div class="control form-group label-floating has-dourado">
                                 <label class="control-label">Escolaridade</label>
                                 <label class="dourado selectpicker error">Ensino médio</label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group ">
                              <span class="input-group-addon ">
                                 <i class="material-icons">mail_outline</i>
                              </span>

                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">CEP</label>
                                 <label id="cep" type="text" class="error">{{-- {{ $solicitante->endereco->cep }} --}} 21.620-420</label>
                              </div>
                           </div>
                        </div>
                     </div> {{-- Fim Sexo, Escolaridade e CEP --}}

                     {{-- UF, Município e Bairro --}}
                     <div class="row">
                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">map</i>
                              </span>
                                     
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">UF</label>
                                 <label class="dourado selectpicker error">RJ</label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group">
                                    <span class="input-group-addon">
                                 <i class="material-icons">business</i>
                              </span>
                                     
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Município</label>
                                 <label id="cidade" name="endereco[municipio]"  type="text" class="error">{{-- {{ $solicitante->endereco->municipio }} --}}Rio de Janeiro </label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">explore</i>
                              </span>

                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Bairro</label>
                                 <label id="bairro" name="endereco[bairro]" type="text" class="error">{{-- {{ $solicitante->endereco->bairro or  old('endereco.bairro') }} --}} Parque Anchieta </label>
                              </div>
                           </div>
                        </div>
                     </div> {{-- Fim UF, Município e Bairro --}}

                     {{-- Logradouro, Número  e Complemento --}}
                     <div class="row">
                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">call_split</i>
                              </span>
                                     
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Logradouro</label>
                                 <label id="rua" name="endereco[logradouro]" type="text" class="error">{{-- {{ $solicitante->endereco->logradouro }} --}}Rua Jurubeba</label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">home</i>
                              </span>

                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Número</label>
                                 <label id="numero" name="endereco[numero]" type="text" class="error">{{-- {{ $solicitante->endereco->numero }} --}} 411 </label>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">location_on</i>
                              </span>

                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Complemento</label>
                                 <label id="numero" name="endereco[numero]" type="text" class="error">{{-- {{ $solicitante->endereco->complemento }} --}}</label>
                              </div>
                           </div>
                        </div>
                     </div> {{-- Fim Logradouro, Número  e Complemento --}}

                     {{-- Telefone e Celular --}}
                     <div class="row">
                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">phone</i>
                              </span>
                                     
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Telefone</label>
                                 <label id="telefone_fixo" name="telefones[0][numero]" type="text" class="error">{{-- {{ $fixo }} --}} (21) 3019-0540 </label>
                              </div>
                           </div>
                        </div>

                        
                        <div class="col-md-4">
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">stay_current_portrait</i>
                              </span>

                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Celular</label>
                                 <label id="telefone_celular" name="telefones[1][numero]" type="text" class="error">{{-- {{ $celular }} --}} (21) 9 8915-3413</label>
                              </div>
                           </div>
                        </div>
                     </div>{{-- Fim Telefone, celular, senha e confirmar senha --}}
                  </div> {{-- Fim card-content --}}
               </div> {{-- FIM ROW --}}
            </form>
         </div> {{-- Fim card-singup --}}
      </div> {{-- Fim col-md-10 --}}

      {{-- Botão Salvar --}}
      <div class="col-md-1 col-md-offset-5">
         <a href="{{ url( "solicitante" ) }}" class="btn btn-dourado btn-lg">Voltar</a>
      </div>
   </div> {{-- Fim container --}}

</div> {{-- FIM ROW --}}

@endsection

@push('scripts')

@endpush