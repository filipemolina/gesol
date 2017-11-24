@extends('layouts.material')

@section('titulo')
<!-- Página Principal -->
@endsection
{{-- 
@section('nome-funcionario')
   {{ $funcionario->nome }}
@endsection --}}

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
            <div class="count">{{ $resultados['solicitacoes']->where('status', 'Aberta')->count() }}</div>
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
            <span class="count_bottom"><i class="dourado"> em dias</span>
        </div>


    </div>

   <div class="row">
      <div class="col-md-5">
         <div class="card">
            <div class="card-header card-header-icon" data-background-color="orange" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>

            <div class="card-content">
               <h4 class="card-title" style="width: 100% !important;">Solicitações Registradas (2017)</h4>
            </div>

            <div class="card card-chart">
               <div class="card-header" data-background-color="orange">
                     <div class="ct-total ct-perfect-fourth"></div> 
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection


@push('scripts')

   <script type="text/javascript">

      var data = {
         labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai','Jun','Jul','Ago','Set','Out', 'Nov' ,'Dez'],
         series: [
            [
               @foreach($resultados['sol_por_mes'] as $mes => $qtd)

                  {{ $qtd }},

               @endforeach
            ],
            
         ]
      };

      var options = {


         width: 390,
         height: 280,

      };

      var defaultOptions = {
         // Options for X-Axis
         axisX: {
             // The offset of the labels to the chart area
             offset: 30,
             // Position where labels are placed. Can be set to `start` or `end` where `start` is equivalent to left or top on vertical axis and `end` is equivalent to right or bottom on horizontal axis.
             position: 'end',
             // Allows you to correct label positioning on this axis by positive or negative x and y offset.
             labelOffset: {
               x: -13,
               y: 0
             },
             // If labels should be shown or not
             showLabel: true,
             // If the axis grid should be drawn or not
             showGrid: true,
             // Interpolation function that allows you to intercept the value from the axis label
             labelInterpolationFnc: Chartist.noop,
             // Set the axis type to be used to project values on this axis. If not defined, Chartist.StepAxis will be used for the X-Axis, where the ticks option will be set to the labels in the data and the stretch option will be set to the global fullWidth option. This type can be changed to any axis constructor available (e.g. Chartist.FixedScaleAxis), where all axis options should be present here.
             type: undefined
         },
            // Options for Y-Axis
            axisY: {
               // The offset of the labels to the chart area
               offset: 40,
               // Position where labels are placed. Can be set to `start` or `end` where `start` is equivalent to left or top on vertical axis and `end` is equivalent to right or bottom on horizontal axis.
               position: 'start',
               // Allows you to correct label positioning on this axis by positive or negative x and y offset.
               labelOffset: {
                  x: 0,
                  y: 10
               },

               // If labels should be shown or not
               showLabel: true,
               // If the axis grid should be drawn or not
               showGrid: true,
               // Interpolation function that allows you to intercept the value from the axis label
               labelInterpolationFnc: Chartist.noop,
               // Set the axis type to be used to project values on this axis. If not defined, Chartist.AutoScaleAxis will be used for the Y-Axis, where the high and low options will be set to the global high and low options. This type can be changed to any axis constructor available (e.g. Chartist.FixedScaleAxis), where all axis options should be present here.
               type: undefined,
               // This value specifies the minimum height in pixel of the scale steps
               scaleMinSpace: 20,
               // Use only integer values (whole numbers) for the scale steps
               onlyInteger: false
            },
            // Specify a fixed width for the chart as a string (i.e. '100px' or '50%')
            width: undefined,
            // Specify a fixed height for the chart as a string (i.e. '100px' or '50%')
            height: undefined,
            // If the line should be drawn or not
            showLine: true,
            // If dots should be drawn or not
            showPoint: true,
            // If the line chart should draw an area
            showArea: false,
            // The base for the area chart that will be used to close the area shape (is normally 0)
            areaBase: 0,
            // Specify if the lines should be smoothed. This value can be true or false where true will result in smoothing using the default smoothing interpolation function Chartist.Interpolation.cardinal and false results in Chartist.Interpolation.none. You can also choose other smoothing / interpolation functions available in the Chartist.Interpolation module, or write your own interpolation function. Check the examples for a brief description.
            lineSmooth: false,
            // If the line chart should add a background fill to the .ct-grids group.
            showGridBackground: false,
            // Overriding the natural low of the chart allows you to zoom in or limit the charts lowest displayed value
            low: undefined,
            // Overriding the natural high of the chart allows you to zoom in or limit the charts highest displayed value
            high: undefined,
            // Padding of the chart drawing area to the container element and labels as a number or padding object {top: 5, right: 5, bottom: 5, left: 5}
            chartPadding: {
               top: 15,
               right: 15,
               bottom: 5,
               left: 10
            },
           
            // When set to true, the last grid line on the x-axis is not drawn and the chart elements will expand to the full available width of the chart. For the last label to be drawn correctly you might need to add chart padding or offset the last label with a draw event handler.
            fullWidth: false,
            // If true the whole data is reversed including labels, the series order as well as the whole series data arrays.
            reverseData: false,
            // Override the class names that get used to generate the SVG structure of the chart
            classNames: {
               chart: 'ct-chart-line',
               label: 'ct-label',
               labelGroup: 'ct-labels',
               series: 'ct-series',
               line: 'ct-line',
               point: 'ct-point',
               area: 'ct-area',
               grid: 'ct-grid',
               gridGroup: 'ct-grids',
               gridBackground: 'ct-grid-background',
               vertical: 'ct-vertical',
               horizontal: 'ct-horizontal',
               start: 'ct-start',
               end: 'ct-end'
            }


      };
  
      // Create a new line chart object where as first parameter we pass in a selector
      // that is resolving to our chart container element. The Second parameter
      // is the actual data object.
      new Chartist.Line('.ct-total', data, defaultOptions);  



   </script>
@endpush




