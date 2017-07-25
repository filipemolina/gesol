<div id="login-servidor">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header rodar_icone">
                    <a class="navbar-brand btn btn-dourado btn-simple btn-wd btn-lg  troca-login-servidor" href="#">
                        <i class="material-icons">cached</i>
                        Alterar para munícipe
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->   
                        @if (Auth::guest())
                            {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}
                            {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="#" action="#">
                                <div class="card card-login card-hidden">
                                    <div class="logo-dourado logo-pn"></div>
                                    <div class="card-header text-center" data-background-color="dourado">
                                        <h4 class="card-title">Login</h4>
                                        <div class="social-line">
                                            <br>
                                            <a href="#btn" class="btn btn-just-icon btn-simple">
                                                <i class="fa"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">perm_identity</i>
                                            </span>
                                            <div class="form-group label-floating has-dourado">
                                                <label class="control-label">Usuário(a)</label>
                                                <input type="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating has-dourado">
                                                <label class="control-label">Senha</label>
                                                <input type="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-dourado btn-wd btn-lg">Acessar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <p class="copyright pull-left">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://tecnologia.mesquita.rj.gov.br" target="_blank" style="font-size: 12px">Subsecretaria da Tecnologia da Informação Equipe de Desenvolvimento de Sistemas Prefeitura Municipal de Mesquita RJ - Rua Arthur Oliveira Vecchi, 120 Centro Mesquita - RJ CEP: 26553-080 2017</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
</div> {{-- FIM LOGIN-SERVIDOR --}}