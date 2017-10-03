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
                <img src="{{-- {{ $funcionario->user->avatar }} --}}" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                   {{-- {{ $funcionario->nome }} --}}
                    <b class="caret"></b>
                    <p style="font-size: 10px;">({{-- {{ $funcionario->acesso }} --}})</p>
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
                <a href="{{ url("/") }}">
                    <i class="material-icons">dashboard</i>
                    <p>Painel de Controle</p>
                </a>
            </li>

             <li>
                    
                    <ul class="nav">
                        <li>
                            <a href="#">
                                <i class="material-icons">lock_outline</i>
                                <p>Alterar Senha</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="material-icons">input</i>
                                <p>Sair</p>
                            </a>
                        </li>
                        
                    </ul>
                </li> 

        </ul>
    </div>
</div>