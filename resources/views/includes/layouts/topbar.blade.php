<nav class="navbar navbar-absolute" style="background: #ad9a75;">
   <div class="container-fluid">
      <div class="navbar-minimize">
         <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
            <i class="material-icons visible-on-sidebar-mini">view_list</i>
         </button>
      </div>
      
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>

         <a class="navbar-brand" href="#"> 
            @section('titulo')  
            @show 
         </a>

         <button class="btn btn-danger" style="display:none" id="btn-permissao">Ative as Notificações para que o Gesol funcione corretamente!</button>
      </div>

      <div class="collapse navbar-collapse">
         <ul class="nav navbar-nav navbar-right">
            <li>
               <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown" style="color: #000000; font-weight: bold;">
                  <i class="material-icons">dashboard</i>
                  <p class="hidden-lg hidden-md">Dashboard</p>
               </a>
            </li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="material-icons" id="icone-notificacoes">notifications</i>
                  <p class="hidden-lg hidden-md">
                     Notifications
                     <b class="caret"></b>
                  </p>
               </a>
               <ul class="dropdown-menu" id="lista-notificacoes">
                  
               </ul>
            </li>
            <li class="dropdown">

              <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown" style="color: #000000; font-weight: bold;">
                  <i class="material-icons">settings</i>
                  <p class="hidden-lg hidden-md">Profile</p>
               </a>

              <ul class="dropdown-menu">
                
                <li>
                  <a href="{{ url("/alteraavatar") }}">
                    <i class="material-icons">person</i> Alterar Avatar
                  </a>
                </li>

                @if($funcionario_logado->role == 'Adm Sistema')
      
             
                 @elseif($funcionario_logado->role =='Adm Secretaria')

                    
                 @elseif($funcionario_logado->role =='Gerir Usuarios')
                    
                    
                    
                 @elseif($funcionario_logado->role =='Padrão')
              
                   
                 @endif
                 

                 <li>
                    <a href="{{ url('/alterasenha') }}" >
                       <i class="material-icons">lock_outline</i> Alterar Senha
                    </a>
                 </li>
                 
                 <hr style="height:1px; border:none; background-color:#A6A6A6; margin-top: 0px; margin-bottom: 0px;margin-left: 5px; margin-right:5px;">

                 <li>
                    <a href="{{ url("/logout") }}" >
                       <i class="material-icons">input</i> Sair
                    </a>
                 </li>

              </ul>
              
            </li>
            
            <li class="separator hidden-lg hidden-md"></li>
         </ul>
      </div>
   </div>
</nav>