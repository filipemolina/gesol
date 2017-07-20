<div class="sidebar" data-active-color="purple" data-background-color="black" data-image="{{ asset('img/sidebar-1.jpg') }}">

    <!--
    Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
    Tip 2: you can also add an image using data-image tag
    Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
    
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            GESOL
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="http://www.creative-tim.com" class="simple-text">
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
                    <b class="caret"></b>
                </a>

                {{-------------- Menu do Usuário --------------}}

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#">Meu Perfil</a>
                        </li>
                        <li>
                            <a href="#">Editar Perfil</a>
                        </li>
                        <li>
                            <a href="#">COnfigurações</a>
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
                    <p>Dashboard</p>
                </a>
            </li>
        </ul>
    </div>
</div>