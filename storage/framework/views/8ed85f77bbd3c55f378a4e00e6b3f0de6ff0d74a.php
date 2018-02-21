<div class="sidebar" data-active-color="" data-background-color="dourado" data-image="<?php echo e(asset('img/prefeitura.png')); ?>">

    <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    
   <div class="logo">
      <a href="#" class="simple-text logo-mini">
         GS
      </a>
      <a href="#" class="simple-text logo-normal">
         GESOL  <i style="font-size: 8px;">( v1.0.2 )</i>
      </a>
   </div>

   <div class="sidebar-wrapper">
      <div class="user">
         <div class="photo">
            <img src="<?php echo e($funcionario_logado->user->avatar); ?>" />
         </div>
         <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
               <span>
                  <?php echo e($funcionario_logado->nome); ?>

                  <b class="caret"></b>
               </span>
               
            </a>

            <div class="clearfix"></div>
               <div class="collapse" id="collapseExample">
                   <ul class="nav">
                       <li>
                           <a href="#">
                              <a href="<?php echo e(url("/alteraavatar")); ?>">
                                    <i class="material-icons">person</i> Alterar Avatar
                              </a>
                           </a>
                       </li>
                       <li>
                           <a href="<?php echo e(url('/alterasenha')); ?>" >
                              <i class="material-icons">lock_outline</i> Alterar Senha
                           </a>
                       </li>
                       <!-- <li>
                           <a href="#">
                               <span class="sidebar-mini"> S </span>
                               <span class="sidebar-normal"> Settings </span>
                           </a>
                       </li> -->
                   </ul>
            </div>

         </div>
      </div>


      

      <ul class="nav">
         <li>
            <a href="<?php echo e(url("/")); ?>">
               <i class="material-icons">dashboard</i>
               <p>Painel</p>
            </a>
         </li>

         <li>
            <a href="<?php echo e(url("/solicitacao")); ?>">
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

         
         
           
          
          

         <?php if($funcionario_logado->role->peso == 10 ): ?>          

         <?php elseif($funcionario_logado->role->peso == 20): ?>             

         <?php elseif($funcionario_logado->role->peso == 30): ?>


         <?php elseif($funcionario_logado->role->peso == 40): ?>    

            <li>
               <a href="<?php echo e(url("/funcionario")); ?>">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>             
         
         <?php elseif($funcionario_logado->role->peso == 60): ?>
            
            <li>
               <a href="<?php echo e(url("/funcionario")); ?>">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>                 
                         
         <?php elseif($funcionario_logado->role->peso == 70): ?>
             
            <li>
               <a href="<?php echo e(url("/funcionario")); ?>">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>                                                      

         <?php elseif($funcionario_logado->role->peso == 80): ?>
             
            <li>
               <a href="<?php echo e(url("/funcionario")); ?>">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>                        
          
         <?php elseif($funcionario_logado->role->peso == 90): ?>
            <li>
               <a href="<?php echo e(url("/funcionario")); ?>">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>

          <?php elseif($funcionario_logado->role->peso == 100): ?>
            <li>
               <a href="<?php echo e(url("/funcionario")); ?>">
                  <i class=" mdi mdi-account-multiple"></i> 
                  <p>Funcionarios</p>
               </a>
            </li>
                        <li>
                           <a href="<?php echo e(url("/relatorio")); ?>">
                              <i class="material-icons">build</i>
                              <span class="sidebar-normal"> Relatorios </span>
                           </a>
                       </li>

            <li>
               <a data-toggle="collapse" href="#componentsExamples" class="collapsed" aria-expanded="false">
                   <i class="material-icons">settings</i>
                   <p> Configurações
                       <b class="caret"></b>
                   </p>
               </a>

               <div class="collapse" id="componentsExamples" aria-expanded="false" style="height: 0px;">
                   <ul class="nav">
                       <li>
                           <a href="<?php echo e(url("/secretaria")); ?>">
                              <i class="material-icons">account_balance</i>
                              <span class="sidebar-normal"> Secretarias </span>
                           </a>
                       </li>
                       <li>
                           <a href="<?php echo e(url("/setor")); ?>">
                              <i class="material-icons">folder_shared</i>
                              <span class="sidebar-normal"> Setores </span>
                           </a>
                       </li>
                       <li>
                           <a href="<?php echo e(url("/servico")); ?>">
                              <i class="material-icons">build</i>
                              <span class="sidebar-normal"> Serviços </span>
                           </a>
                       </li>
                       <li>
                            <a href="<?php echo e(url("/atribuicao")); ?>">
                            <i class="material-icons">compare_arrows</i>
                            <span class="sidebar-normal"> Atribuições </span>
                            </a>
                        </li>
                   </ul>
               </div>
           </li>
           
         <?php endif; ?>

         <li>
            <a href="<?php echo e(url("/comunicado")); ?>">
               <i class="material-icons">chat bubble</i>
               <p>Comunicados</p>
            </a>
         </li>
      </ul>
      
   </div>
</div>