<div class="sidebar" data-active-color="" data-background-color="dourado" data-image="{{ asset('img/prefeitura.png') }}">

    <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    

    <div class="logo" style="color: #000000;">
        <a href="#" class="simple-text">
            GESOL
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
                <img src="{{ asset('img/faces/avatar.jpg') }}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    Tania Andrew
                    {{-- <b class="caret"></b> --}}
                </a>

                {{-------------- Menu do Usuário --------------}}

                {{-- <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#">Meu Perfil</a>
                        </li>
                        <li>
                            <a href="#">Editar Perfil</a>
                        </li>
                        <li>
                            <a href="#">Configurações</a>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
        
        {{-------------- Menu Principal --------------}}

        <ul class="nav">

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