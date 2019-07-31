@extends('layouts.material')

@section('titulo')

	Relatorios

@endsection

@section('content')

<div class="row" style="max-width: 100%">
   <div class="col-md-12 col-mc-offset-0">
      <div class="card" style="padding-left: 6%">
         <img src="../img/BrasaoTopSetrans.png"/>
         <div>
            <h3 style="text-align:center">Relatório</h3>
         </div>

         <div class="row" style="font-size: 17px; padding-left: 80%">
            <tr>
               <td>{{$relatorio->numero}}</td>
            </tr>
         </div>

         <div class="row" style="font-size: 12px;padding-top: 25px;text-align:center;display:  flex;justify-content: space-around;">
               Cone: {{$relatorio->cones}} /

               Placa: {{$relatorio->placas}} / 
         
               Bombonas: {{$relatorio->bombonas}} / 
         
               Radios: {{$relatorio->radios}} / 
         
               Lanternas: {{$relatorio->lanternas}} 
         </div>

         <div>
		
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
           
         </div>
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
            

      </div>
   </div>
</div>

@endsection