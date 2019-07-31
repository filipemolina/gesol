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
  bottom: -20px;

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
.page-number {
  text-align: center;
}
.page-number:before {
  content: "Pagina " counter(page);
}

</style>
</head>

<body>

<div id="header">
  <table>
    <tr>
    	<center><img src="./img/BrasaoTopsetrans.png"/></center>
    </tr>
  </table>
</div>

<div id="footer">
 <table>
    <tr>
    	<center><img src="./img/BrasaoFooter2.png"/></center>
    	<div class="page-number"></div>
    </tr>
  </table>
</div>
		{{-- Campos do Relatorio --}}
							
	<h2 style="text-align:center;">RELATÓRIO</h2>

	<div class="row" style="padding-left: 80%;">
			{{-- {{ $relatorio->tipo }} --}}
		  {{ $relatorio->numero}}
	  </div>

	<h4> Quantidade de Materiais</h4>
	 
	<div class="row">
		&nbsp;&nbsp;&nbsp;
		Cone: {{$relatorio->cones}} &nbsp;&nbsp;&nbsp;

		Placa: {{$relatorio->placas}} &nbsp;&nbsp;&nbsp;

		Bombonas: {{$relatorio->bombonas}} &nbsp;&nbsp;&nbsp;

		Radios: {{$relatorio->radios}} &nbsp;&nbsp;&nbsp;

		Lanternas: {{$relatorio->lanternas}}
	</div>
	<br>
	<table>
		
		<tr>
			<td><span style="font-weight:bold">&nbsp;&nbsp;Outros:</span></td>
			<td>{{$relatorio->outros}}</td>
		</tr>

		<tr>
			<td><span style="font-weight:bold;">&nbsp;&nbsp;Data:</span></td>
			<td>{{ date('d-m-Y', strtotime($relatorio->data)) }}</td>
			<td><span style="font-weight:bold;">Hora:</span></td>
			<td>{{ $relatorio->hora }}</td>
		</tr>  
	</table>

	<br>
	<div class="container">
		<span style="font-weight:bold;">Relato da Ocorrencia:</span>
		{{ $relatorio->registro_ocorrencia }}
	</div>
	<br>
	<div>
			<span style="font-weight:bold;">Outros Funcionarios:</span> 
				@foreach($relatorio->funcionarios()->where("relator", false)->get() as $funcionario)
					{{ $funcionario->nome }} /
				@endforeach
		</div>
			<br>
		
	 	<div>
			<span style="font-weight:bold;">Nome:</span>  {{ $relatorio->funcionarios()->where("relator", true)->first()->nome }} 
			<span style="font-weight:bold;">Matrícula:</span> {{ $relatorio->funcionarios()->where("relator", true)->first()->matricula }}
		 </div>
		 
		 <div class="Imangemsemsop">
				@foreach($imagens as $imagem)

				  <img class="semsopimagem" src="{{$imagem->imagem}}" >

			  @endforeach
	  </div>
	

</body>
</html>







