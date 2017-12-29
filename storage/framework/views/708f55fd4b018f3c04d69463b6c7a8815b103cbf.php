<?php $__env->startSection('titulo'); ?>

  Painel <?php echo e(mostraAcesso($funcionario_logado)); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

 <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">
               <i class="material-icons" style="font-size: 14px">assignment</i> 
               Total de Solicitações
            </span>
            <div class="count"><?php echo e($resultados['solicitacoes']->count()); ?></div>
            
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-bullhorn"></i> Total de Abertas</span>
            <div class="count"><?php echo e($resultados['abertas']); ?></div>
            
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-check"></i> Total de Solucionadas</span>
            <div class="count" style="color: green"><?php echo e($resultados['solicitacoes']->where('status', 'Solucionada')->count()); ?></div>
            
        </div>

         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-times-o"></i> Atrasadas</span>
            <div class="count" style="color: red"><?php echo e($resultados['sol_prazo']["vencida"]); ?></div>
            
         </div>

         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-minus-o "></i> Vencendo hoje</span>
            <div class="count" style="color: orange"><?php echo e($resultados['sol_prazo']["vencendo"]); ?></div>
            
        </div>
   
         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Tempo de solução</span>
            <div class="count"><?php echo e($resultados['sol_media']); ?></div>
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
            

            <div class="col-lg-6 col-md-7 col-sm-3" style="margin-left: 20px;" >
               <select style="margin-bottom: 0px;" name="select_secretaria" id="select_secretaria" class="selectpicker"  data-style="select-with-transition" data-size="7" >

                  <?php $__currentLoopData = $resultados['secretarias_graficos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secretaria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="" ><?php echo $secretaria['nome']; ?></option>  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               </select>
            </div>
           
            <div  id='ser_mais_solicitados_secretaria' style="height:400px;" ></div>
   
            <div>
                   
            </div>

         </div>
      </div>
   </div>
  


   
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
            
               
                           
                        
            


   <script type="text/javascript">

      let secretarias_graficos = [];
      
      // Criar os vetores que irão abastecer o gráfico
      let legendas = [];
      let series = [];

      <?php $__currentLoopData = $resultados['secretarias_graficos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secretaria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

         secretarias_graficos.push(<?php echo json_encode($secretaria); ?>);

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
            data: ['<?php echo e($resultados['ano_anterior']); ?>','<?php echo e($resultados['ano']); ?>']
         },

         // title : {
         //    text: 'Solicitações Registradas',
         //    subtext: '<?php echo e($resultados['ano_anterior']); ?> e <?php echo e($resultados['ano']); ?>',
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
               name:'<?php echo e($resultados['ano']); ?>',
               type:'line',
               smooth: true,
               data: 
               [ 
                  <?php $__currentLoopData = $resultados['sol_por_mes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes => $qtd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                     <?php echo e($qtd); ?>, 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               ],
            },
            {
               name:'<?php echo e($resultados['ano_anterior']); ?>',
               type:'line',
               smooth: true,
               data: 
               [ 
                  <?php $__currentLoopData = $resultados['sol_por_mes_ano_anterior']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mes => $qtd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                     <?php echo e($qtd); ?>, 
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

      <?php $__currentLoopData = $resultados['sol_secretaria_total']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
         nameList.push('<?php echo e($sol->sigla); ?>');
         legendData.push('<?php echo e($sol->sigla); ?>');


         seriesData.push({
            name: '<?php echo e($sol->sigla); ?>',
            value: <?php echo e($sol->total); ?>

        });

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php $__currentLoopData = $resultados['sol_secretaria_aberta']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
         seriesData2.push({
            name: '<?php echo e($sol->sigla); ?>',
            value: <?php echo e($sol->total); ?>

        });

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      

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

      <?php $__currentLoopData = $resultados['sol_bairro']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
         nameList.push('<?php echo e($sol->bairro); ?>');
         legendData.push('<?php echo e($sol->bairro); ?>');

         seriesData.push({
            name: '<?php echo e($sol->bairro); ?>',
            value: <?php echo e($sol->total); ?>

        });

         novo.push({
            name: '<?php echo e($sol->bairro); ?>',
            y: <?php echo e($sol->total); ?>

        });

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
    
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

   
      <?php $__currentLoopData = $resultados['ser_mais_solicitados_secretaria']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            legendData.push('<?php echo e($sol->secretaria); ?>');
            seriesData.push({
               name: '<?php echo e($sol->nome); ?>',
               value: <?php echo e($sol->total); ?>

           });
         
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.material', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>