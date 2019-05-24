<nav class="navbar navbar-absolute" style="background: #ad9a75 !important;">
   <div class="container-fluid">
      <div class="collapse navbar-collapse">
         <ul class="navbar-right">
            <li class="dropdown" style="float: right;">
               <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown" style="color: #000000; font-weight: bold;">
                  <i class="material-icons">settings</i>
               </a>
               
               <ul class="dropdown-menu">
                  <li>
                     <a href="{{ url("/alteraavatar") }}">
                       <i class="material-icons">person</i> Alterar Avatar
                     </a>             
                  
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
         </ul>
      </div>
   </div>
</nav>