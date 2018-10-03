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

		<link href="{{ asset('css/demo.css') }}" rel="stylesheet" />

		<!--  Material styles CSS    -->
		<link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

		<!--  ANIMATE styles CSS    -->
		<link href="{{ asset('css/animate.css') }}" rel="stylesheet" />


		<!--     Fonts and icons     -->
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
		<!-- meterial fonts     -->
		<link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet" />

		<!-- bootstrap-colorpicker     -->
		<link href="{{ asset('bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />

		{{-- <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.conversejs.org/css/converse.min.css"> --}}
		{{-- Converse.JS --}}
		<link rel="stylesheet" type="text/css" href="{{ asset('js/converse/converse.css') }}">

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
			<div style="clear:both"></div>
		</div>
		
		{{--  Deve ser rodado o comando php artisan passport:install (quando o banco estiver vazio) para que essa linha funcione  --}}

		{{-- Áudio das Notificações --}}

		<audio id='audio_notificacao'>
			<source src="{{ asset('js/super_mario_coin.mp3') }}" type="audio/mpeg">
		</audio>
			
		<script>
			//variáveis globais ao sistema
			let url_base       = "{{ url("/") }}"; //Não tem barra no final
			let token          = "{{ csrf_token() }}";

			let nome        = "{{ $funcionario_logado->nome }}";
			let user_id     = {{ $funcionario_logado->user->id }};
			let setor       = "{{ $funcionario_logado->setor->nome }}";
			let setor_id    = "{{ $funcionario_logado->setor->id }}";
			let sigla       = "{{ $funcionario_logado->setor->secretaria->sigla }}";
			let email       = "{{ $funcionario_logado->user->email }}";

			let tokenGesol  = "{{ $funcionario_logado->user->createToken('Web')->accessToken }}";

			let qtd_notificacoes = 0;
			let notificacoes = [];
		</script>

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

		{{-- Converse.js --}}
		<script src="https://cdn.conversejs.org/dist/converse.min.js"></script>

		{{-- Strophe.js Usado para fazer a conexão automárica do Converse.js --}}
		<script src="{{ asset('js/strophe.js') }}"></script>
		<script src="{{ asset('js/strophe.register.js') }}"></script>

		{{-- MD5 --}}
		<script src="{{ asset('js/md5.min.js') }}"></script>


		{{-- Funções Javascript --}}
		<script src="{{ asset('js/functions.js') }}"></script>

		{{-- Javascript do Projeto --}}
		<script src="{{ asset('js/scripts.js') }}"></script>

		{{-- Funções do Firebase --}}
		<script src="{{ asset('js/firebase.js') }}"></script>

		@stack('scripts')
	</body>
</html>