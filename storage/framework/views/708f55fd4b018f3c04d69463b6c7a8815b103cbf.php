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
           
            <div  id='sol_maiores' style="height:400px;" ></div>
   
         </div>
      </div>
   </div>


  


   
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
            
               
                           
                        
            


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
                  radius : [20, 110],
                  
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
  
   
      bairroChart.setOption(bairroOpcoes);



      //=============================================================================================
      //=============================================================================================
      //===========  SERVIÇOS MAIS SOLICITADOS                          =============================
      //=============================================================================================
      //=============================================================================================

      var nameList = [];
      var legendData = [];
      var seriesData = [];
      var teste = [];
      var novo =[];
      var seriesDataAnoAnterior =[];

      <?php $__currentLoopData = $resultados['sol_maiores']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
         nameList.push('<?php echo e($sol->nome); ?>');
         legendData.push('<?php echo e($sol->nome); ?>');

         seriesData.push({
            name: '<?php echo e($sol->nome); ?>',
            value: <?php echo e($sol->total); ?>

        });

         novo.push({
            name: '<?php echo e($sol->nome); ?>',
            y: <?php echo e($sol->total); ?>

        });

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
    
      // based on prepared DOM, initialize echarts instance
      var maioresChart = echarts.init(document.getElementById('sol_maiores'));//,null, {renderer: 'svg'});
      
      maioresOpcoes = {
          
         tooltip : {
            trigger: 'axis',
            axisPointer : {            
               type : 'shadow'        
            }
          },

          legend: {
              x : 'center',
              y : 'bottom',
              data: legendData
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
               data : legendData
            }
         ],

         yAxis : [
            {
               type : 'value'
            }
         ],

        
          series : [
              {
                
                  name: '<?php echo e($resultados['ano']); ?>',
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
                  lableLine: {
                      normal: {
                          show: false
                      },
                      emphasis: {
                          show: false
                      }
                  },
                  data: seriesData
              }
          ]
      };

  
      maioresChart.setOption(maioresOpcoes);

















   </script>
<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.material', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>