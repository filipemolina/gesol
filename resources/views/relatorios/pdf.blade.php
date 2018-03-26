<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Relatório</title>
<style type="text/css">
@page {
	margin: 2cm;
	margin-top: 50px; 
	margin-bottom: 160px;
}
body {
    font-family: sans-serif;
    font-size:15px;
	margin: 0.5cm 0;
	text-align: justify;
}

#header {
top: -50px; 
position: fixed;
}

#footer {
  position: fixed;
  left: 0;
	right: 0;
	color: #000000;
	font-size: 0.9em;
}

#footer {
  bottom: -50px;

}
#header table {

}
#footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}
#header td {

}
#footer td {
  padding: 0;
	width: 10%;
}
.page-footer {
  text-align: center;
}
hr {
  page-break-after: always;
  border: 0;
}
table.separate {
  border-collapse: separate;
  border-spacing: 20pt;
  
}



</style>
  
</head>

<body>

<div id="header">
  <table>
    <tr>
    	<center><img src="./img/BrasaoTop.png"/></center>
    </tr>
  </table>
</div>


	
<div id="footer">
 <table>
    <tr>
    	<center><img src="./img/BrasaoFooter2.png"/></center>
    </tr>
  </table>
</div>
							{{-- Campos do Relatorio --}}
	<br>
	<br>
	<br>
	 <h2 style="text-align:center;">RELATÓRIO</h2>

	<table>
	<tr>
		<td>{{ $relatorio->tipo }}</td>
	</tr>
	</table>	
	
	<br>

	<table class="separate">
	<tr >
		<td colspan="2">@if($relatorio->notificacao==1 ) Notificado @endif</td>
		<td colspan="2">@if($relatorio->autuacao==1 ) Autuado @endif</td> 
		<td colspan="2">@if($relatorio->multa==1 ) Multado @endif</td>
		<td colspan="2">@if($relatorio->registro_dp==1 ) Registrado na DP @endif</td>  
		<td colspan="2">@if($relatorio->auto_pf==1 ) Auto de Prisão em Flagrante @endif</td>
	</tr>
	</table>

	<br>
		{{--  --}}
	<table cellpadding="5" cellspacing="0" style="width: 100%;">

	    <tr>
			<td><span style="font-weight:bold;">Origem do Serviço:</span></td>
			<td>{{ ($relatorio->origem) }}</td>
		</tr> 

		{{--  --}}

		<tr>
			<td><span style="font-weight:bold;">Data:</span></td>
			<td>{{ $relatorio->data }}</td>
			<td><span style="font-weight:bold;">Hora:</span></td>
			<td>{{ $relatorio->hora }}</td>
		</tr>  

		{{--  --}}

	 	<tr>
			<td><span style="font-weight:bold;">Local:</span></td>
			<td>{{$relatorio->endereco->bairro}}, {{ $relatorio->endereco->cep }}, {{ $relatorio->endereco->logradouro }}, {{ $relatorio->endereco->numero }} {{ $relatorio->endereco->complemento}}
			</td>
		</tr>

		{{--  --}}

		 <tr>
			<td><span style="font-weight:bold;">Envolvidos:</span></td>
			<td>{{ $relatorio->envolvidos }}</td>
		</tr> 
		
		{{--  --}}

		 <tr>
			<td><span style="font-weight:bold;">Ação Desenvolvida:</span></td>
			<td>{{ $relatorio->acao_cop }} {{ $relatorio->acao_gcmm }}</td>
		</tr>
		
		{{--  --}}

		<tr>
			<td colrow="6"><span style="font-weight:bold;">Relato Sucinto:</span></td>
			<td>{{ $relatorio->relato }}</td>
		</tr>

		{{--  --}}

		 <tr>
			<td><span style="font-weight:bold;">Providências Adotadas:</span></td>
			<td>{{ $relatorio->providencia }}</td>
		</tr>

		{{--  --}}

		<tr>
			<td><span style="font-weight:bold;">Outros Funcionarios:</span></td> 
			@foreach($relatorio->funcionarios()->where("relator", false)->get() as $funcionario)
				<td> {{ $funcionario->nome }} </td>
			@endforeach
		</tr>
		<tr> 	
			<td><span style="font-weight:bold;">Nome:</span></td> <td> {{ $relatorio->funcionarios()->where("relator", true)->first()->nome }} </td> 
			<td><span style="font-weight:bold;">Matrícula:</span></td> <td> {{ $relatorio->funcionarios()->where("relator", true)->first()->matricula }}</td>
		</tr>


	</table>

</body></html>