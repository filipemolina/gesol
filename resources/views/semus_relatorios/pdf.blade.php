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
	 margin: 2.5cm 0;
	 text-align: justify;
}
#header { 
			position: fixed; 
			top: -30px; 
			left: 0px; 
			right: 0px;  
			height: 50px; }

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
td{
    padding: 4px;
}

.container{
	 justify-content: flex-start;
}
.semsopimagem {
  margin-top: 1cm;
  height: 260px !important;
  width: 260px !important;

}

.Imangemsemsop{
  margin: 0 auto !important;
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

	
	 <h2 style="text-align:center;">RELATÓRIO</h2>

	<table cellpadding="5" cellspacing="0" style="width: 100%;">

		 <tr>
			<td><span style="font-weight:bold;">Prioridade:</span></td>
			<td>{{ $relatorio->prioridade }}</td>
		</tr>

	    <tr>
			<td><span style="font-weight:bold;">Unidade:</span></td>
			<td>{{ ($relatorio->unidade) }}</td>
		</tr> 

		{{--  --}}

		<tr>
			<td><span style="font-weight:bold;">Data:</span></td>
			<td>{{ date('d-m-Y', strtotime($relatorio->data)) }}</td>
			<td><span style="font-weight:bold;">Hora:</span></td>
			<td>{{ $relatorio->hora }}</td>
		</tr>  


	</table>

		
		{{--  --}}
<br>

		<div class="container">
			<span style="font-weight:bold;">Responsavel:</span>
		   {{ $relatorio->responsavel }}
		</div>
		<br>
		
		<div class="container">
			<span style="font-weight:bold;">Relato:</span>
		   {{ $relatorio->relato }}
		</div>
		<br>
	
 		<div class="Imangemsemsop">
 				@foreach($imagens as $imagem)

					<img class="semsopimagem" src="{{$imagem->imagem}}" >

				@endforeach
		</div>

</body></html>







