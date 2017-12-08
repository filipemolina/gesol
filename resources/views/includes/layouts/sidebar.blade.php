<div class="sidebar" data-active-color="" data-background-color="dourado" data-image="{{ asset('img/prefeitura.png') }}">

    <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    
   <div class="logo" style="color: #000000;">
      <a href="#" class="simple-text">
         GESOL  <i style="font-size: 10px;">( v0.1.3 )</i>
      </a>
   </div>
   <div class="logo logo-mini">
      <a href="#" class="simple-text">
         GS
      </a>
   </div>
   <div class="sidebar-wrapper">
      <div class="user">
         <div class="photo">
            <img src="{{ $funcionario_logado->user->avatar }}" />
         </div>
         <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
               {{ $funcionario_logado->nome }}
               <b class="caret"></b>
               <p style="font-size: 10px;">({{ $funcionario_logado->role->acesso }} - {{ $funcionario_logado->role->peso }})</p>

               
            </a>

         </div>
      </div>


      {{-------------- Menu Principal --------------}}

      <ul class="nav">
         <li>
            <a href="{{ url("/") }}">
               <i class="material-icons">dashboard</i>
               <p>Painel</p>
            </a>
         </li>

         <li>
            <a href="{{ url("/solicitacao") }}">
               <i class="material-icons">assignment</i>
               <p>Solicitações</p>
            </a>
         </li>

   <!--  //  "1"     "Desativado"        "0"     
         //  "2"     "Moderador"         "10"    
         //  "3"     "SAC"               "20"    
         //  "4"     "Funcionario"       "30"    
         //  "5"     "Funcionario_SUP"   "40"    
         //  "6"     "Funcionario_ADM"   "50"    
         //  "7"     "Secretario"        "60"    
         //  "8"     "Ouvidor"           "70"    
         //  "9"     "Prefeito"          "80"    
         //  "10"    "TI"                "90"    
         //  "11"    "DSV"               "100"    -->

         
         
           {{-- chama a view de acordo com o tipo de acesso do usuario logado --}}
          
          

         @if($funcionario_logado->role->peso == 10 )          

         @elseif($funcionario_logado->role->peso == 20)             

         @elseif($funcionario_logado->role->peso == 30)


         @elseif($funcionario_logado->role->peso == 40)    

            <li>
               <a href="{{ url("/funcionario") }}">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>             

         @elseif($funcionario_logado->role->peso == 50)    

            <li>
               <a href="{{ url("/funcionario") }}">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>             
         
         @elseif($funcionario_logado->role->peso == 60)
            
            <li>
               <a href="{{ url("/funcionario") }}">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>                 
                         
         @elseif($funcionario_logado->role->peso == 70)
             
            <li>
               <a href="{{ url("/funcionario") }}">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>                                                      

         @elseif($funcionario_logado->role->peso == 80)
             
            <li>
               <a href="{{ url("/funcionario") }}">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>                        
          
         @elseif($funcionario_logado->role->peso == 90)
            <li>
               <a href="{{ url("/funcionario") }}">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>

          @elseif($funcionario_logado->role->peso == 100)
            <li>
               <a href="{{ url("/funcionario") }}">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>
           
         @endif


      </ul>
   </div>
</div>