<div class="sidebar" data-active-color="" data-background-color="dourado" data-image="{{ asset('img/prefeitura.png') }}">

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
		 	GESOL  <i style="font-size: 8px;">( v1.2.1.psg )</i>
	  	</a>
   </div>

   <div class="sidebar-wrapper">
	  	<div class="user">
		 	<div class="photo">
				<img src="{{ $funcionario_logado->user->avatar }}" />
		 	</div>
		 	<div class="info">
				<a data-toggle="collapse" href="#collapseExample" class="collapsed">
			   	<span>
				  		{{ $funcionario_logado->nome }}
				  		<b class="caret"></b>
			   	</span>
			   	{{-- <p style="font-size: 10px;">({{ $funcionario_logado->role->acesso }} - {{ $funcionario_logado->role->peso }})</p> --}}
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

	  {{-------------- Menu Principal --------------}}

	  	<ul class="nav">
		 	<li>
				<a href="{{ url("/") }}">
			   	<i class="material-icons">dashboard</i>
			   	<p>Painel</p>
				</a>
		 	</li>
		
			{{--  verifica se tem essas atribuições. elas mudam o comportamento do sistema para
			ser utilizado pela semsop para a geração de relatórios de ocorrencias  --}}
			@if(verificaAtribuicoes($funcionario_logado, ["SEMSOP_REL_FISCAL","SEMSOP_REL_GCMM","SEMSOP_REL_GERENTE"]))
			 	<li>
					<a href="{{ url("/semsop") }}">
						<i class="assignment"></i> 
						<p>SEMSOP Relatórios</p>
					</a>
				</li>
			@endif   
			@if(verificaAtribuicoes($funcionario_logado, ["SEMUS_REL","SEMUS_REL_GERENTE"]))
			 	<li>
					<a href="{{ url("/semus") }}">
						<i class="assignment"></i> 
						<p>SEMUS Relatórios</p>
					</a>
				</li>
			@else
				<li>
					<a href="{{ url("/solicitacao") }}">
						<i class="material-icons">assignment</i>
						<p>Solicitações</p>
					</a>
				</li>
			@endif


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
								<a href="{{ url("/secretaria") }}">
									<i class="material-icons">account_balance</i>
									<span class="sidebar-normal"> Secretarias </span>
								</a>
							</li>
							<li>
								<a href="{{ url("/setor") }}">
									<i class="material-icons">folder_shared</i>
									<span class="sidebar-normal"> Setores </span>
								</a>
							</li>
							<li>
								<a href="{{ url("/servico") }}">
									<i class="material-icons">build</i>
									<span class="sidebar-normal"> Serviços </span>
								</a>
							</li>
							<li>
								<a href="{{ url("/atribuicao") }}">
								<i class="material-icons">compare_arrows</i>
								<span class="sidebar-normal"> Atribuições </span>
								</a>
							</li>
						</ul>
					</div>
				</li>

			@endif
			

			<li>
				<a href="{{ url("/comunicado") }}">
					<i class="material-icons">chat bubble</i>
					<p>Comunicados</p>
				</a>
			</li>
		</ul>
		  
		<div id="footer">
			<center>
					<img src="{{asset("img/cidade-digital.png")}}" style="width: 160px;padding-top: 0%;">
					
			</center>
		</div>
	  	{{-- <p>({{ $funcionario_logado->role->acesso }} - {{ $funcionario_logado->role->peso }})</p> --}}
   </div>
</div>