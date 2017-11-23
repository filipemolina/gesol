@extends('layouts.material')

@section('titulo')

  Painel - {!! $funcionario_logado->setor->secretaria->nome !!}

@endsection

@section('content')

 <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">
               <i class="material-icons" style="font-size: 14px">assignment</i> 
               Total de Solicitações
            </span>
            <div class="count">{{ $resultados['solicitacoes']->count() }}</div>
            {{-- <span class="count_bottom"><i class="dourado">4% </i> de aumento</span> --}}
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-bullhorn"></i> Total de Abertas</span>
            <div class="count">{{ $resultados['abertas'] }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>3% </i> de aumento</span> --}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-check"></i> Total de Solucionadas</span>
            <div class="count" style="color: green">{{ $resultados['solicitacoes']->where('status', 'Solucionada')->count() }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>34% </i> de aumento</span> --}}
        </div>

         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-times-o"></i> Atrasadas</span>
            <div class="count" style="color: red">{{ $resultados['sol_prazo']["vencida"] }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>34% </i> de aumento</span> --}}
         </div>

         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-minus-o "></i> Vencendo hoje</span>
            <div class="count" style="color: orange">{{ $resultados['sol_prazo']["vencendo"] }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>34% </i> de aumento</span> --}}
        </div>
   
         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Tempo de solução</span>
            <div class="count">{{ $resultados['sol_media'] }}</div>
            <span class="count_bottom"><i class="dourado">dias</span>
        </div>
    </div>

   <!-- <div id="sol_total" style="width: 600px;height:400px;"></div> -->

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

   <div class="row" style="margin-top: 0px;">
      <div class="col-md-12">
         <div class="card" style="padding-bottom: 30px;">
             <div class="card-header card-header-icon" data-background-color="orange" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>
            <div class="card-content-grafico" style="padding-bottom: 0px">
               <h4 class="card-title-grafico" style="width: 100% !important;">Serviços mais solicitados</h4>
            </div>
           
            <div  id='sol_maiores' style="height:300px;" ></div>
   
         </div>
      </div>
   </div>

  


   
@endsection


@push('scripts')
            {{-- {  "name": "{{ $resultados['ano_anterior'] }}",  --}}
               {{-- "data":  [@foreach($resultados['sol_por_mes_ano_anterior']  as $mes => $qtd)  --}}
                           {{-- {{ $qtd }},  --}}
                        {{-- @endforeach]    --}}
            {{-- }, --}}


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
            data: ['{{ $resultados['ano_anterior'] }}','{{ $resultados['ano'] }}']
         },

         // title : {
         //    text: 'Solicitações Registradas',
         //    subtext: '{{ $resultados['ano_anterior'] }} e {{ $resultados['ano'] }}',
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
            name:'{{ $resultados['ano'] }}',
            type:'line',
            smooth: true,
            data: 
            [ 
               @foreach($resultados['sol_por_mes'] as $mes => $qtd) 
                  {{ $qtd }}, 
               @endforeach
            ],
         },{
            name:'{{ $resultados['ano_anterior'] }}',
            type:'line',
            smooth: true,
            data: 
            [ 
               @foreach($resultados['sol_por_mes_ano_anterior'] as $mes => $qtd) 
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


      // var dados2 = [];

      // @foreach($resultados['sol_maiores'] as $sol) 
      //    dados2.push("{value: {{ $sol->total }}, name: '{{ $sol->nome }}\'}," );

      //    //          {value:335, name:'asdasd'},
      // @endforeach
               
      // console.log(dados2);




      var nameList = [];
      var legendData = [];
      var seriesData = [];
      var teste = [];
      var novo =[];

      @foreach($resultados['sol_maiores'] as $sol) 
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

    
      // based on prepared DOM, initialize echarts instance
      var maioresChart = echarts.init(document.getElementById('sol_maiores'),null, {renderer: 'svg'});

      

      maioresOpcoes = {

         // legend: {
         //    bottom: 10,
         //    //left: 'center',
         //    type: 'scroll',
         //    orient: 'vertical',
         //    right: 100,
         //    top: 200,
            
         //    data: legendData
         // },
         tooltip: {
            trigger: 'item',
            formatter: "{d}%"
         },
         
         // legend: {
         //    orient: 'vertical',
         //    x: 'left',
         //    data:legendData
         // },

        
         toolbox: {
            height : 6,
            show : true,
            itensize : 5,
            feature : {
               mark : {show: false},
               dataView : {show: true, readOnly: false},
               // magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
               restore : {show: true},
               saveAsImage : {show: true}
            }
         },


         series : [
         {
            type: 'pie',
            data: seriesData,
            hoverAnimation : true,
            hoverOffset : 10,
            label: {
                normal: {
                    show: false,
                    position: 'center'
                },
             },

            name: '{{ $resultados['ano'] }}',

            radius : [20, 150],
            
            selectedMode: 'single',
            roseType : 'radius',
            
           }
         ]
      };
   
      maioresChart.setOption(maioresOpcoes);

      // var currentIndex = -1;

      // setInterval(function () {
      //     var dataLen = option.series[0].data.length;

      //     maioresChart.dispatchAction({
      //         type: 'downplay',
      //         seriesIndex: 0,
      //         dataIndex: currentIndex
      //     });
      //     currentIndex = (currentIndex + 1) % dataLen;

      //     maioresChart.dispatchAction({
      //         type: 'highlight',
      //         seriesIndex: 0,
      //         dataIndex: currentIndex
      //     });

      //     maioresChart.dispatchAction({
      //         type: 'showTip',
      //         seriesIndex: 0,
      //         dataIndex: currentIndex
      //     });
      // }, 1000);



   </script>
@endpush



