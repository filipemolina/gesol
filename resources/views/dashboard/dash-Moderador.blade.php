@extends('layouts.material')

@section('titulo')

  Painel {{ mostraAcesso($funcionario_logado) }}

@endsection

@section('content')

   @include('dashboard.dash-Top')
   
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-header-icon" data-background-color="orange" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>

            <div class="card-content-grafico">
               <h4 class="card-title-grafico" style="width: 100% !important;">Solicitações Registradas</h4>
            </div>

            <div class="card-chart">
               <div class="card-header" id='sol_total' style="height:350px" ></div>
            </div>
         </div>
      </div>
   </div>

  

   
@endsection


@push('scripts')
   <script type="text/javascript">



      //=============================================================================================
      //=============================================================================================
      //=============================================================================================
      //=============================================================================================
      //=============================================================================================

      // based on prepared DOM, initialize echarts instance
      var totalChart = echarts.init(document.getElementById('sol_total'));

        // specify chart configuration item and data
      var option = {
         legend: {
            type: 'plain',
            orient: 'horizontal',
            top : 30,
            left: 10,
            data: ['{{ $ano_anterior }}','{{ $ano }}']
         },

         // title : {
         //    text: 'Solicitações Registradas',
         //    subtext: '{{ $ano_anterior }} e {{ $ano }}',
         //    x:'center'
         // },

         tooltip: {
            trigger: 'axis',
            axisPointer: {
               type: 'cross'
            }
         },

         toolbox: {
            height : 6,
            show : true,
            itensize : 5,
            feature : {
               mark : {show: false},
               dataView : {show: true, readOnly: false},
               magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
               restore : {show: true},
               saveAsImage : {show: true}
            }
         },

         xAxis:  {
              type: 'category',
              boundaryGap: false,
              data: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai','Jun','Jul','Ago','Set','Out', 'Nov' ,'Dez']
         },
         
         yAxis: {
              type: 'value',
              axisLabel: {
                  formatter: '{value}'
              },
              axisPointer: {
                  snap: true
              }
         },
         
         series: [{
            name:'{{ $ano }}',
            type:'line',
            smooth: true,
            data: 
            [ 
               @foreach($sol_por_mes as $mes => $qtd) 
                  {{ $qtd }}, 
               @endforeach
            ],
         },{
            name:'{{ $ano_anterior }}',
            type:'line',
            smooth: true,
            data: 
            [ 
               @foreach($sol_por_mes_ano_anterior as $mes => $qtd) 
                  {{ $qtd }}, 
               @endforeach
            ],
         }]
      };

      // use configuration item and data specified to show chart
      totalChart.setOption(option);

      //=============================================================================================
      //=============================================================================================
      //=============================================================================================
      //=============================================================================================
      //=============================================================================================


      
      var nameList = [];
      var legendData = [];
      var seriesData = [];
      var teste = [];
      var novo =[];

      @foreach($solicitacoes_maiores as $sol) 
         nameList.push('{{ $sol->nome }}');
         legendData.push('{{ $sol->nome }}');
         //seriesData.push({{ $sol->total }});
         //teste.push({{ $sol->total }}, '{{ $sol->nome }}');

         seriesData.push({
            name: '{{ $sol->nome }}',
            value: {{ $sol->total }}
        });

         novo.push({
            name: '{{ $sol->nome }}',
            y: {{ $sol->total }}
        });

      @endforeach

    
   </script>
@endpush




