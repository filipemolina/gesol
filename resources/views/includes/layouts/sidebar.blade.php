<div class="sidebar" data-active-color="" data-background-color="dourado" data-image="{{ asset('img/prefeitura.png') }}">
   <div class="logo">
	  	<a href="#" class="simple-text logo-normal">
		 	GESOL  <i style="font-size: 8px;">( v2.0.0.psg )</i>
	  	</a>
   </div>

   <div class="sidebar-wrapper">
	  	 <div class="user"> 
		 	 <div class="photo">
				<img src="{{ $logado->avatar }}" />
			</div> 
			<div style="font-size: 15px;padding-top: 10px;">
				{{$logado->nome}}
			</div>
		 	<div class="info">
				 <a data-toggle="collapse" href="#collapseExample" class="collapsed">
			   	<span>
				  		 {{ $funcionario_logado }} 
				  		<b class="caret"></b>
			   	</span> 
				</a>

				<div class="clearfix"></div>
			    <div class="collapse" id="collapseExample">
				   <ul class="nav">
					   <li>
						   <a href="#">
							  <a href="{{ url("/alteraavatar") }}">
									<i class="material-icons">person</i> Alterar Avatar
							  </a>
						   </a>
					   </li>
					   <li>
						   <a href="{{ url('/alterasenha') }}" >
							  <i class="material-icons">lock_outline</i> Alterar Senha
						   </a>
					   </li>
					    <li>
						   <a href="#">
							   <span class="sidebar-mini"> S </span>
							   <span class="sidebar-normal"> Settings </span>
						   </a>
					   </li> 
				   </ul>
				</div> 
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
				<a href="{{ url("/semsop") }}">
					<i class="material-icons">assignment</i>
					<p>SEMSOP Relatórios</p>
				</a>
			</li>
		
		</ul>
		  
		<div id="footer">
			<center>
				<img src="{{asset("img/cidade-digital.png")}}" style="width: 160px;padding-top: 0%;">		
			</center>
		</div>
   </div>
</div>