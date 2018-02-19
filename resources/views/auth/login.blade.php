<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="perfect-scrollbar-on">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>360| login</title>

   <!-- Styles -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
   <meta name="viewport" content="width=device-width" />
   
   <!-- Bootstrap core CSS     -->
   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
   <!--  Material Dashboard CSS    -->
   <link href="{{ asset('css/material-dashboard.css?v=1.2.1') }}" rel="stylesheet" />

   
   <!--  CSS for Demo Purpose, don't include it in your project     -->
   <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />

   <!--     Fonts and icons     -->
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

   <link href="{{ asset('css/animate.css') }}" rel="stylesheet" />
   <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>

<body class="fundo_dourado">

   <nav class="navbar navbar-default navbar-static-top animated fadeInDownBig">

   </nav>

   <div class="wrapper wrapper-full-page">
      <br><br>
      <div class="full-page login-page" filter-color="black" data-image="{{ asset("/img/prefeitura.png") }}">
         <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
         <div class="content">
            <div class="container">
               <div class="row">
                  <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                     <form method="POST" action="{{ url('/login') }}">
                        {{-- Token CSRF --}}
                        {{ csrf_field() }}

                        {{-- DIV login --}}
                        <div id="login-municipe" class="card card-login card-hidden">
                           <div class="logo-dourado logo-pn"></div>
                           <div class="card-header text-center" data-background-color="dourado">
                              <div class="social-line"><br><br><br></div>
                           </div>
                           <div class="card-content">
                              <div class="input-group">
                                 <span class="input-group-addon">
                                    <i class="material-icons">perm_identity</i>
                                 </span>
                                 <div class="form-group label-floating has-dourado">
                                    <label class="control-label">Usuário(a)</label>
                                    <input type="email" class="form-control" name="email">
                                 </div>
                              </div>
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <i class="material-icons">lock_outline</i>
                              </span>
                              <div class="form-group label-floating has-dourado">
                                 <label class="control-label">Senha</label>
                                 <input type="password" class="form-control" name="senha">
                              </div>
                              <div>
                                 <a href="{{ url("/password/reset")}}" class="recupera_senha texto-roxo">Esqueceu sua Senha?</a>   
                               </div>
                           </div>
                        </div>
                        <div class="footer text-center">
                           <button type="submit" class="btn btn-dourado btn-wd btn-lg">Acessar</button>
                        </div>
                     </div> {{-- FIM DIV login --}}
                  </form>
               </div>
            </div>
         </div>
      </div>

      @include('includes.layouts.footer')

   </div>
</div>

 <!-- Firebase - Enviar e receber notificações do google -->
        <script src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>

        <script src="https://maps.google.com/maps/api/js?key=AIzaSyDcdW2PsrS1fbsXKmZ6P9Ii8zub5FDu3WQ"></script>

        <script src="{{ asset('js/jquery-3.2.1.min.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

        <script src="{{ asset('js/moment.min.js') }}"></script>

        <script src="{{ asset('js/chartist.js') }}"></script>

        <script src="{{ asset('js/jquery.bootstrap-wizard.js') }}"></script>

        <script src="{{ asset('js/bootstrap-notify.js') }}"></script>

        <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

        <!-- bootstrap-colorpicker     -->
        <script src="{{ asset('/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"> </script>

        <script src="{{ asset('js/jquery-jvectormap.js') }}"></script>

        <script src="{{ asset('js/nouislider.min.js') }}"></script>

        <script src="{{ asset('js/jquery.select-bootstrap.js') }}"></script>

        <script src="{{ asset('js/sweetalert2.js') }}"></script>

        <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>

        <script src="{{ asset('js/jquery.tagsinput.js') }}"></script>

        <script src="{{ asset('js/material-dashboard.js') }}"></script>

        <script src="{{ asset('js/demo.js') }}"></script>

        {{-- Vanilla Masker --}}

        <script src="{{ asset('js/vanillaMasker.min.js') }}"></script>

        <script src="{{ asset('js/echarts-en.min.js') }}"></script>

        {{-- DataTables --}}

        <script type="text/javascript" src="{{ asset('js/jquery.datatables.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/dataTables.responsive.min.js') }}"></script>

        {{-- Moment --}}
        <script src="{{ asset('js/datetime-moment.js') }}"></script>
        <script src="{{ asset('js/fullcalendar.min.js') }}"></script>


        {{-- Funções Javascript --}}
        <script src="{{ asset('js/functions.js') }}"></script>

        {{-- Javascript do Projeto --}}
        <script src="{{ asset('js/scripts.js') }}"></script>

        {{-- Funções do Firebase --}}
        <script src="{{ asset('js/firebase.js') }}"></script>

        @stack('scripts')

      @include('includes.login.scripts')

</body>
</html>