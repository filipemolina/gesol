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
      <div class="col-md-6">
         <div class="card" style="padding-bottom: 30px;">
             <div class="card-header card-header-icon" data-background-color="orange" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>
            <div class="card-content-grafico" style="padding-bottom: 20px">
               <h4 class="card-title-grafico" style="width: 100% !important;">Solicitações por Secretaria</h4>
            </div>
           
            <div  id='sol_secretaria' style="height:400px;" ></div>
   
         </div>
      </div>


      <div class="col-md-6">
         <div class="card" style="padding-bottom: 30px;">
             <div class="card-header card-header-icon" data-background-color="orange" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>
            <div class="card-content-grafico" style="padding-bottom: 20px">
               <h4 class="card-title-grafico" style="width: 100% !important;">Solicitações por Bairros</h4>
            </div>
           
            <div  id='sol_bairro' style="height:400px;" ></div>
   
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
            {{-- <label class="control-label" style="margin-left: 20px;">Secretaria</label> --}}

            <div class="col-lg-6 col-md-7 col-sm-3" style="margin-left: 20px;" >
               <select style="margin-bottom: 0px;" name="select_secretaria" id="select_secretaria" class="selectpicker"  data-style="select-with-transition" data-size="7" >

                  @foreach($secretarias_graficos as $secretaria)
                     <option value="" >{!! $secretaria['nome'] !!}</option>  
                  @endforeach

               </select>
            </div>
           
            <div  id='ser_mais_solicitados_secretaria' style="height:400px;" ></div>
   
            <div>
                   
            </div>

         </div>
      </div>
   </div>
  


   
@endsection


@push('scripts')
            

   <script type="text/javascript">

      let secretarias_graficos = [];
      
      // Criar os vetores que irão abastecer o gráfico
      let legendas = [];
      let series = [];

      @foreach($secretarias_graficos as $secretaria)

         secretarias_graficos.push({!! json_encode($secretaria) !!});

      @endforeach

      $(function(){

         
         $("#select_secretaria").on("changed.bs.select", function(e){

            //console.log($("#select_secretaria :selected").text());
            legendas = [];
            series = [];
            data = [];

            // Obter todos os serviços da secretaria

            let secretaria_selecionada = secretarias_graficos.filter(function(valor){

               return valor.nome == $("#select_secretaria :selected").text();

            });

            // Obter apenas o primeiro resultado da busca
            secretaria_selecionada = secretaria_selecionada[0];

            //console.log(secretaria_selecionada);
            //console.log(secretarias_graficos);

            // Iterar por todos os serviços da secretaria selecionada
            for(var servico in secretaria_selecionada.servicos){

               if(secretaria_selecionada.servicos.hasOwnProperty(servico)){

                  // Colocar o nome do serviço no vetor de legendas
                  legendas.push(servico);

                  // Inserir os dados
                  data.push({
                    name : servico,
                    value: secretaria_selecionada.servicos[servico]
                  });

               }

            }

            // Atualizar o gráfico com a função definida no arquivo functions.js

            atualizaGrafico(maioresChart, legendas, data);

         });

         $("#select_secretaria").trigger("changed.bs.select");

      });



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
      var seriesData2 = [];

      @foreach($solicitacoes_secretaria_total as $sol) 
         nameList.push('{{ $sol->sigla }}');
         legendData.push('{{ $sol->sigla }}');


         seriesData.push({
            name: '{{ $sol->sigla }}',
            value: {{ $sol->total }}
        });

      @endforeach

      @foreach($solicitacoes_secretaria_aberta as $sol) 
         seriesData2.push({
            name: '{{ $sol->sigla }}',
            value: {{ $sol->total }}
        });

      @endforeach      

      // based on prepared DOM, initialize echarts instance
      var totalChart = echarts.init(document.getElementById('sol_secretaria'));

        // specify chart configuration item and data
      var option = {

         tooltip: {
            trigger: 'axis',
            axisPointer: {
               type: 'shadow'
            }
         },

         grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
         },
         
         xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
         },
         
         yAxis: {
            type: 'category',
            data: legendData
         },

        series: [
          {
              name: 'Total',
              type: 'bar',
              data: seriesData
          },
          {
              name: 'Não solucionadas ainda',
              type: 'bar',
              data: seriesData2
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

      @foreach($solicitacoes_bairro as $sol) 
         nameList.push('{{ $sol->bairro }}');
         legendData.push('{{ $sol->bairro }}');

         seriesData.push({
            name: '{{ $sol->bairro }}',
            value: {{ $sol->total }}
        });

         novo.push({
            name: '{{ $sol->bairro }}',
            y: {{ $sol->total }}
        });

      @endforeach

        
    
      // based on prepared DOM, initialize echarts instance
      var bairroChart = echarts.init(document.getElementById('sol_bairro'));//,null, {renderer: 'svg'});
      
      bairroOpcoes = {
         
         

          tooltip : {
              trigger: 'item',
              formatter: "{b} : {c} <br/> ({d}%)"
          },
          legend: {
              type: 'scroll',
              orient: 'vertical',
              right: 10,
              top: 20,
              bottom: 20,
              data: legendData
          },
          calculable : true,
          series : [
             {
  
                  type:'pie',
                  radius : [10, 130],

                  hoverOffset: 20,
                  selectedOffset: 30,

                  
                  
                  label: {
                      normal: {
                          show: true,
                          fontsize: 10,
                      },
                      emphasis: {
                          show: true
                      }
                      
                  },
                  lableLine: {
                      normal: {
                          show: true
                      },
                      emphasis: {
                          show: true
                      }
                  },
                  data: seriesData
              }
          ]
      };
  
   
      bairroChart.setOption(bairroOpcoes);



      //=============================================================================================
      //=============================================================================================
      //===========  SERVIÇOS MAIS SOLICITADOS  POR SECRETARIAS         =============================
      //=============================================================================================
      //=============================================================================================


      var legendData = [];
      var seriesData = [];
      
      var seriesDataAnoAnterior =[];

   
      @foreach($servicos_mais_solicitados_secretaria as $sol) 
            legendData.push('{{ $sol->secretaria }}');
            seriesData.push({
               name: '{{ $sol->nome }}',
               value: {{ $sol->total }}
           });
         
      @endforeach

      /////////////////////////////////////////// CÓDIGO DO MOLINA        
    
      // based on prepared DOM, initialize echarts instance
      var maioresChart = echarts.init(document.getElementById('ser_mais_solicitados_secretaria'));//,null, {renderer: 'svg'});
      
      maioresOpcoes = {

         tooltip : {
            trigger: 'axis',
            axisPointer : {            
               type : 'shadow'        
            }
          },

         grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
         },

         xAxis : [
            {
               type : 'category',

               axisLabel : {
                  rotate: -20,
                  fontSize: 10
               }
               // data : legendData,

            }
         ],

         yAxis : [
            {
               type : 'value'
            }
         ],

        
         series : [
            {
               barMaxWidth: 60,
               type:'bar',
               label: {
                   normal: {
                       show: false,
                       fontsize: 10
                   },
                   emphasis: {
                       show: false
                   }
               },

               // data: seriesData
            }
         ]
      };

  
      maioresChart.setOption(maioresOpcoes);


   </script>
@endpush




