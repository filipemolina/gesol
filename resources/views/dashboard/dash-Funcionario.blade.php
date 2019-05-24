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

   <div class="row" style="margin-top: 0px;">
      <div class="col-md-12">
         <div class="card" style="padding-bottom: 30px;">
             <div class="card-header card-header-icon" data-background-color="orange" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>
            <div class="card-content-grafico" style="padding-bottom: 20px">
               <h4 class="card-title-grafico" style="width: 100% !important;">Serviços mais solicitados</h4>
            </div>
           
            <div  id='sol_maiores' style="height:400px;" ></div>
   
         </div>
      </div>
   </div>

  


   
@endsection


@push('scripts')
            {{-- {  "name": "{{ $ano_anterior'] }}",  --}}
               {{-- "data":  [@foreach($sol_por_mes_ano_anterior']  as $mes => $qtd)  --}}
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
               magicType : {show: true, type: ['line', 'bar']},
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
         
         series: [
            {
               name:'{{ $ano }}',
               type:'line',
               smooth: true,
               data: 
               [ 
                  @foreach($sol_por_mes as $mes => $qtd) 
                     {{ $qtd }}, 
                  @endforeach
               ],
            },
            {
               name:'{{ $ano_anterior }}',
               type:'line',
               smooth: true,
               data: 
               [ 
                  @foreach($sol_por_mes_ano_anterior as $mes => $qtd) 
                     {{ $qtd }}, 
                  @endforeach
               ],
            }
         ]
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
      var seriesDataAnoAnterior =[];

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

      @foreach($solicitacoes_maiores_ano_anterior as $sol) 

         seriesDataAnoAnterior.push({
            name: '{{ $sol->nome }}',
            value: {{ $sol->total }}
        });

      @endforeach

         
    
      // based on prepared DOM, initialize echarts instance
      var maioresChart = echarts.init(document.getElementById('sol_maiores'));//,null, {renderer: 'svg'});
      
      maioresOpcoes = {
          
          tooltip : {
              trigger: 'item',
              formatter: "{a} <br/>{b} : {c} ({d}%)"
          },
          legend: {
              x : 'center',
              y : 'bottom',
              data: legendData
          },
          toolbox: {
              show : true,
              feature : {
                  mark : {show: true},
                  dataView : {show: true, readOnly: false},
                  magicType : {
                      show: true,
                      type: ['pie', 'funnel']
                  },
                  restore : {show: true},
                  saveAsImage : {show: true}
              }
          },
          calculable : true,
          series : [
              {
                  name: '{{ $ano_anterior }}',
                  type:'pie',
                  radius : [20, 110],
                  center : ['25%', '50%'],
                  roseType : 'radius',
                  label: {
                      normal: {
                          show: true
                      },
                      emphasis: {
                          show: true
                      }
                  },
                  lableLine: {
                      normal: {
                          show: false
                      },
                      emphasis: {
                          show: true
                      }
                  },
                  data: seriesDataAnoAnterior
              },
              {
                  name: '{{ $ano }}',
                  type:'pie',
                  radius : [30, 110],
                  center : ['75%', '50%'],
                  roseType : 'area',
                  label: {
                      normal: {
                          show: true,
                          fontsize: 10
                      },
                      emphasis: {
                          show: true
                      }
                  },
                  lableLine: {
                      normal: {
                          show: false
                      },
                      emphasis: {
                          show: true
                      }
                  },
                  data: seriesData
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




