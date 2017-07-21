<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Ouvidoria de Mesquita</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

 <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />    
</head>

<body>
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {{-- <a class="navbar-brand" href=" ../dashboard.html ">Material Dashboard Pro</a> --}}
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        {{-- <a href="{{ asset('dashboard.html') }}">
                            <i class="material-icons">dashboard</i> Dashboard
                        </a> --}}
                    </li>
                    <li class=" active ">
                        <a href="register.html">
                            <i class="material-icons">person_add</i> Register
                        </a>
                    </li>
                    <li class="">
                        <a href="login.html">
                            <i class="material-icons">fingerprint</i> Login
                        </a>
                    </li>
                    <li class="">
                        {{-- <a href="lock.html">
                            <i class="material-icons">lock_open</i> Lock
                        </a> --}}
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page register-page" filter-color="black" data-image="{{ asset('img/register.jpeg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="card card-signup" style="opacity: 0.7;">
                            <h2 class="card-title text-center">Registro</h2>
                            <div class="row">
                                <div class="col-md-5 col-md-offset-1">
                                    <div class="card-content">
                                        {{-- <div class="info info-horizontal">
                                            <div class="icon icon-rose">
                                                <i class="material-icons">timeline</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Marketing</h4>
                                                <p class="description">
                                                    We've created the marketing campaign of the website. It was a very interesting collaboration.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-primary">
                                                <i class="material-icons">code</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Fully Coded in HTML5</h4>
                                                <p class="description">
                                                    We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="info info-horizontal">
                                            <div class="icon icon-info">
                                                <i class="material-icons">group</i>
                                            </div>
                                            <div class="description">
                                                <h4 class="info-title">Built Audience</h4>
                                                <p class="description">
                                                    There is also a Fully Customizable CMS Admin Dashboard for this product.
                                                </p>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin: 0 auto; float: none;">
                                    <div class="social text-center" style="margin-top: 20px;">
                                       {{--  <button class="btn btn-just-icon btn-round btn-twitter">
                                            <i class="fa fa-twitter"></i>
                                        </button>
                                        <button class="btn btn-just-icon btn-round btn-dribbble">
                                            <i class="fa fa-dribbble"></i>
                                        </button> --}}
                                        <button class="btn btn-just-icon btn-round btn-facebook">
                                            <i class="fa fa-facebook"> </i>
                                        </button>
                                        <h4> Entre com Facebook ou Crie sua Conta!</h4>
                                    </div>
                                    <form class="form" method="" action="">
                                        <div class="card-content">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">face</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Nome Completo">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                <input type="text" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">credit_card</i>
                                                </span>
                                                <input id="cpf" type="text" class="form-control" placeholder="CPF">
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <input type="password" placeholder="Senha" class="form-control" />
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">lock_outline</i>
                                                </span>
                                                <input type="password" placeholder="Confirmar Senha" class="form-control" />
                                            </div>
                                            <!-- If you want to add a checkbox to this form, uncomment this code -->
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="optionsCheckboxes" checked> Eu Concordo com os
                                                    <a href="#something">termos e condições</a>.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="footer text-center">
                                            <a href="#pablo" class="btn btn-primary btn-round">Começar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <nav class="pull-left">
                        {{-- <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul> --}}
                    </nav>
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://tecnologia.mesquita.rj.gov.br">Subsecretaria da Tecnologia da Informação</a><br>
Equipe de Desenvolvimento de Sistemas
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{ asset('js/moment.min.js') }}"></script>
<!--  Charts Plugin -->
<script src="{{ asset('js/chartist.min.js') }}"></script>
<!--  Plugin for the Wizard -->
<script src="{{ asset('js/jquery.bootstrap-wizard.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<!-- DateTimePicker Plugin -->
<script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>
<!-- Vector Map plugin -->
<script src="{{ asset('js/jquery-jvectormap.js') }}"></script>
<!-- Sliders Plugin -->
<script src="{{ asset('js/nouislider.min.js') }}"></script>
<!-- Select Plugin -->
<script src="{{ asset('js/jquery.select-bootstrap.js') }}"></script>
<!--  DataTables.net Plugin    -->
<script src="{{ asset('js/jquery.datatables.js') }}"></script>
<!-- Sweet Alert 2 plugin -->
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin    -->
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>
<!-- TagsInput Plugin -->
<script src="{{ asset('js/jquery.tagsinput.js') }}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{ asset('js/material-dashboard.js') }}"></script>

<script src="{{ asset('js/vanillaMasker.min.js') }}"></script>

<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/demo.js') }}"></script>
<script type="text/javascript">
    $().ready(function() {

        VMasker ($("#cpf")).maskPattern("999.999.999-99");

        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

</html>