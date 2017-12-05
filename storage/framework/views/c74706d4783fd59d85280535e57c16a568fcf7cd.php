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
         <a class="navbar-brand" href="#"> <?php $__env->startSection('titulo'); ?>  <?php echo $__env->yieldSection(); ?> </a>
      </div>

      <div class="collapse navbar-collapse">
         <ul class="nav navbar-nav navbar-right">
            <li>
               <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown" style="color: #000000; font-weight: bold;">
                  <i class="material-icons">dashboard</i>
                  <p class="hidden-lg hidden-md">Dashboard</p>
               </a>
            </li>
<!--             <li class="dropdown">
   <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="material-icons">notifications</i>
      <span class="notification">5</span>
      <p class="hidden-lg hidden-md">
         Notifications
         <b class="caret"></b>
      </p>
   </a>
   <ul class="dropdown-menu">
      <li>
         <a href="#">Mike John responded to your email</a>
      </li>
      <li>
         <a href="#">You have 5 new tasks</a>
      </li>
      <li>
         <a href="#">You're now friend with Andrew</a>
      </li>
      <li>
         <a href="#">Another Notification</a>
      </li>
      <li>
         <a href="#">Another One</a>
      </li>
   </ul>
</li>  -->

            <li class="dropdown">
               <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown" style="color: #000000; font-weight: bold">
                  <i class="material-icons">settings</i>
                  <p class="hidden-lg hidden-md">Profile</p>
               </a>

               <ul class="dropdown-menu">
               <li>
                  <a href="<?php echo e(url("/alteraavatar")); ?>" >
                     <i class="material-icons">person</i> Alterar Avatar
                  </a>
               </li>

               <?php if($funcionario_logado->role == 'Adm Sistema'): ?>
      
             
               <?php elseif($funcionario_logado->role =='Adm Secretaria'): ?>

                  
               <?php elseif($funcionario_logado->role =='Gerir Usuarios'): ?>
                  
                  
                  
               <?php elseif($funcionario_logado->role =='Padrão'): ?>
            
                 
               <?php endif; ?>
               

               <li>
                  <a href="<?php echo e(url('/alterasenha')); ?>" >
                     <i class="material-icons">lock_outline</i> Alterar Senha
                  </a>
               </li>
               
               <hr style="height:1px; border:none; background-color:#A6A6A6; margin-top: 0px; margin-bottom: 0px;margin-left: 5px; margin-right:5px;">

               <li>
                  <a href="<?php echo e(url("/logout")); ?>" >
                     <i class="material-icons">input</i> Sair
                  </a>
               </li>
            </li>
            <li class="separator hidden-lg hidden-md"></li>
         </ul>
         
      </div>
   </div>
</nav>