@extends('layouts.material')

@section('titulo')

Registrar Solicitante

@endsection

@section('content')

<div class="row">
   <div class="container">            
      {{-- Dados pessoas --}}
      <div class="col-md-10">
         <div class="card card-singup">
            <form method="get" action="{{-- {{ url("solicitante/$solicitante->id") }} --}}" class="form-horizontal">
               {{-- {!! method_field('PUT') !!}

               {{ csrf_field() }} --}}
               
               {{-- Ícone título --}}
               <div class="card-header card-header-icon" data-background-color="dourado">
                  <i class="material-icons">person</i>
               </div>

               {{-- Título --}}
               <div class="card-content">
                  <h4 class="card-title no-padding">Dados</h4>
               </div>         
               
               <div class="row">
                  
                  {{-- Dados --}}
                  <div class="col-md-12">
                     <div class="card-content">
                        
                        {{-- Nome e Email --}}
                        <div class="row">
                           <div class="col-md-6">
                              <div class="input-group">
                                 <span class="input-group-addon ">
                                    <i class="material-icons">face</i>
                                 </span>

                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Nome</label>
                                    <input type="text" class="form-control error" 
                                    value="{{-- {{$solicitante->nome}} --}}">
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
                                    <input type="text" name="email" type="email" class="form-control error" 
                                    value="{{-- {{ $solicitante->email}} --}}">
                                 </div>
                              </div>
                           </div>
                        </div> {{-- Fim nome e e-mail --}}

                        {{-- CPF, Nascimento e Sexo --}}
                        <div class="row">
                           <div class="col-md-3">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">credit_card</i>
                                 </span>
                                        
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">CPF</label>
                                    <input id="cpf" type="text" class="form-control error" 
                                    value="{{-- {{ $solicitante->cpf or  old('cpf') }} --}}">
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
                                    <input type="type" class="form-control datetimepicker error" value="{{-- {{ $solicitante->nascimento or  old('nascimento') }} --}}">
                                 </div>
                              </div>
                           </div>
                           
                           <div class="col-md-3">
                              <div class="input-group">
                                       <span class="input-group-addon">
                                    <i class="material-icons">wc</i>
                                 </span>

                                 <div class="control form-group label-floating has-dourado">
                                    <label class="control-label">Sexo</label>
                                    <select class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
                                       <option >Sexo</option>
                                       <option value="2">Masculino</option>
                                       <option value="3">Feminino</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div> {{-- Fim CPF, Nascimento e Sexo --}}

                        {{-- Escolaridade, cep, uf e município --}}
                        <div class="row">
                           <div class="col-md-4">
                              <div class="input-group">
                                       <span class="input-group-addon">
                                    <i class="material-icons">card_membership</i>
                                 </span>

                                 <div class="control form-group label-floating has-dourado">
                                    <label class="control-label">Escolaridade</label>
                                    <select class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
                                       <option disabled selected>Escolaridade</option>
                                       <option value="2">Fundamental</option>
                                       <option value="3">Ensino médio</option>
                                       <option value="3">Ensino superior</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="input-group ">
                                 <span class="input-group-addon ">
                                    <i class="material-icons">mail_outline</i>
                                 </span>

                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">CEP</label>
                                    <input id="cep" type="text" class="form-control error" 
                                    value="{{-- {{ $solicitante->endereco->cep }} --}}">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-2">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">map</i>
                                 </span>
                                        
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">UF</label>
                                    <select class="dourado selectpicker error" data-style="select-with-transition has-dourado" data-size="7">
                                       <option disabled selected>UF</option>
                                       <option value="2">RJ</option>
                                       <option value="3">SP</option>
                                    </select>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="input-group">
                                       <span class="input-group-addon">
                                    <i class="material-icons">business</i>
                                 </span>
                                        
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Município</label>
                                    <input id="cidade" name="endereco[municipio]"  type="text" class="form-control error" value="{{-- {{ $solicitante->endereco->municipio }} --}}">
                                 </div>
                              </div>
                           </div>
                        </div> {{-- Fim Escolaridade, cep, uf e município --}}

                        {{-- Bairro, logradouro, número  e complemento --}}
                        <div class="row">
                           <div class="col-md-3">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">explore</i>
                                 </span>

                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Bairro</label>
                                    <input id="bairro" name="endereco[bairro]" type="text" class="form-control error" value="{{-- {{ $solicitante->endereco->bairro or  old('endereco.bairro') }} --}}">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">call_split</i>
                                 </span>
                                        
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Logradouro</label>
                                    <input id="rua" name="endereco[logradouro]" type="text" class="form-control error" value="{{-- {{ $solicitante->endereco->logradouro }} --}}">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-2">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">home</i>
                                 </span>

                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Número</label>
                                    <input id="numero" name="endereco[numero]" type="text" class="form-control error" value="{{-- {{ $solicitante->endereco->numero }} --}}">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">location_on</i>
                                 </span>

                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Complemento</label>
                                    <input id="numero" name="endereco[numero]" type="text" class="form-control error" value="{{-- {{ $solicitante->endereco->complemento  or  old('endereco.complemento') }} --}}">
                                 </div>
                              </div>
                           </div>
                        </div> {{-- Fim Bairro, logradouro, número  e complemento --}}

                        {{-- Telefone, celular, senha e confirmar senha --}}
                        <div class="row">
                           <div class="col-md-3">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">phone</i>
                                 </span>
                                        
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Telefone</label>
                                    <input id="telefone_fixo" name="telefones[0][numero]" type="text" class="form-control error" value="{{-- {{ $fixo }} --}}">
                                 </div>
                              </div>
                           </div>

                           
                           <div class="col-md-3">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">stay_current_portrait</i>
                                 </span>

                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Celular</label>
                                    <input id="telefone_celular" name="telefones[1][numero]" type="text" class="form-control error" value="{{-- {{ $celular }} --}}">
                                    <input type="hidden" name="telefones[1][tipo_telefone]" value="Celular">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                 </span>
                                 
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Senha</label>
                                    <input type="password" name="password" class="form-control error" 
                                    value="">
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">lock_outline</i>
                                 </span>
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Confirmar senha</label>
                                    <input type="password" name="password" type="password" class="form-control error" value="">
                                 </div>
                              </div>
                           </div>
                        </div>{{-- Fim Telefone, celular, senha e confirmar senha --}}
                     </div> {{-- Fim card-content --}}
                  </div> {{-- Fim col-md-12 --}}

                  {{-- Foto --}}
                  <div class="col-md-4 flt-r maior no-padding">
                     <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle">
                           <img src="{{ asset ('img/placeholder.jpg') }}" alt="...">
                        </div>

                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                        <div>
                           <span class="btn btn-round btn-dourado btn-file">
                              <span class="fileinput-new">Adicionar</span>
                              <span class="fileinput-exists">Alterar</span>
                              <input type="file" name="..." />
                           </span>
                           <br />
                           <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                     </div>
                  </div> {{-- Fim foto --}}
               </div> {{-- FIM ROW --}}
            </form>
         </div> {{-- Fim card-singup --}}
      </div> {{-- Fim col-md-10 --}}

      {{-- Botão Salvar --}}
      <div class="col-md-4 col-md-offset-4">
         <button type="submit" class="btn btn-dourado btn-lg">Salvar</button>
      </div>
   </div> {{-- Fim container --}}
</div> {{-- FIM ROW --}}

@endsection

@push('scripts')

{{-- Atualiza os campos do endereço de acordo com o cep digitado --}}
   <script src="{{ asset("js/endereco.js") }}"></script>

   <!-- DateTimePicker Plugin -->
   <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

   <script type="text/javascript">
      $(document).ready(function() {
         VMasker ($("#cep")).maskPattern("99999-999");
         VMasker ($("#telefone_fixo")).maskPattern("(99) 9999-9999");
         VMasker ($("#telefone_celular")).maskPattern("(99) 99999-9999");


         //para adicionar a foto 
         $("body").on("change.bs.fileinput", function(e){ 
            var base64 = $(".fileinput-preview img").attr('src');
            $("input[name=foto]").val(base64);
         });



         var tempo = 0;
         var incremento = 500;

        // Testar se há algum erro, e mostrar a notificação

         @if ($errors->any())
            
             @foreach ($errors->all() as $error)

                setTimeout(function(){
                    demo.notificationRight("top", "right", "rose", "{{ $error }}");   
                }, tempo);

                tempo += incremento;

             @endforeach
                
        @endif
         demo.initFormExtendedDatetimepickers();
      });
   </script>

   <script type="text/javascript">
   
   // javascript for init
   $('.datetimepicker').datetimepicker({
      icons: {
         time: "fa fa-clock-o",
         date: "fa fa-calendar",
         up: "fa fa-chevron-up",
         down: "fa fa-chevron-down",
         previous: 'fa fa-chevron-left',
         next: 'fa fa-chevron-right',
         today: 'fa fa-screenshot',
         clear: 'fa fa-trash',
         close: 'fa fa-remove'
      }
   });
   </script>

@endpush