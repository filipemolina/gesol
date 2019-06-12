<div class="sidebar" data-active-color="" data-background-color="dourado" data-image="<?php echo e(asset('img/prefeitura.png')); ?>">
	<div class="logo">
		   <a href="#" class="simple-text logo-normal">
			  GESOL  <i style="font-size: 8px;">( v2.0.0.psg )</i>
		   </a>
	</div>
 
	<div class="sidebar-wrapper">
			<div class="user"> 
			   <div class="photo">
				 <img src="<?php echo e($logado->avatar); ?>" />
			 </div> 
			 <div style="font-size: 15px;padding-top: 10px;">
				 <?php echo e($logado->nome); ?>

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
				 <a href="<?php echo e(url("/semsop")); ?>">
					 <i class="material-icons">assignment</i>
					 <p>SEMSOP Relatórios</p>
				 </a>
			 </li>
		 
		 </ul>
		   
		 <div id="footer">
			 <center>
				 <img src="<?php echo e(asset("img/cidade-digital.png")); ?>" style="width: 160px;padding-top: 0%;">		
			 </center>
		 </div>
	</div>
 </div>