<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> @section('titulo') @show </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />

    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

    <!-- =============================================================================== -->
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
    <!-- =============================================================================== -->

    <!--  Material styles CSS    -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <!-- meterial fonts     -->
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet" />



    @stack('css')
    
</head>

<body>
    <div class="wrapper">

        {{-- Menu Lateral --}}
        
        @include('includes.layouts.sidebar')

        <div class="main-panel">

            {{-- Menu Superior --}}
            
            @include('includes.layouts.topbar')


            <div class="content" style="padding-top: 10px;
                                        padding-bottom: 0px;
                                        padding-left: 20px;
                                        padding-right: 20px;">

                <div class="container-fluid">

                    {{-- Conteúdo Principal --}}
    
                    @yield('content')

                </div>
            </div>

            {{-- Rodapé --}}

            @include('includes.layouts.footer')
            
        </div>
    </div>


        <script>
            
            //variáveis globais ao sistema
            let url_base       = "{{ url("/") }}";
            let token          = "{{ csrf_token() }}";

    	    let nome  = "{{ $funcionario_logado->nome }}";
    	    let setor = "{{ $funcionario_logado->setor->nome }}";
    	    let sigla = "{{ $funcionario_logado->setor->secretaria->sigla }}";
        </script>


        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

        <script src="{{ asset('js/moment.min.js') }}"></script>


        <script src="{{ asset('js/chartist.min.js') }}"></script>

        <script src="{{ asset('js/jquery.bootstrap-wizard.js') }}"></script>

        <script src="{{ asset('js/bootstrap-notify.js') }}"></script>

        <script src="{{ asset('js/bootstrap-datetimepicker.js') }}"></script>

        <script src="{{ asset('js/jquery-jvectormap.js') }}"></script>

        <script src="{{ asset('js/nouislider.min.js') }}"></script>

        <script src="https://maps.google.com/maps/api/js?key=AIzaSyDcdW2PsrS1fbsXKmZ6P9Ii8zub5FDu3WQ"></script>

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

        @stack('scripts')

    </body>
</html>