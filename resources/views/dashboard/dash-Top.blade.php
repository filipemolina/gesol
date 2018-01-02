<div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">
               <i class="material-icons" style="font-size: 14px">assignment</i> 
               Total de Solicitações
            </span>

            <div class="count">{{ $solicitacoes_todas->count() }}</div>

            {{-- <span class="count_bottom"><i class="dourado">4% </i> de aumento</span> --}}
        </div>

        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-bullhorn"></i> Total de Abertas</span>
            <div class="count">{{ $abertas }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>3% </i> de aumento</span> --}}
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-check"></i> Total de Solucionadas</span>
            <div class="count" style="color: green">{{ $solicitacoes_todas->where('status', 'Solucionada')->count() }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>34% </i> de aumento</span> --}}
        </div>

         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-times-o"></i> Atrasadas</span>
            <div class="count" style="color: red">{{ $sol_prazo['vencida'] }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>34% </i> de aumento</span> --}}
         </div>

         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-minus-o "></i> Vencendo hoje</span>
            <div class="count" style="color: orange">{{ $sol_prazo["vencendo"] }}</div>
            {{-- <span class="count_bottom"><i class="dourado"><i class="fa fa-sort-asc"></i>34% </i> de aumento</span> --}}
        </div>
   
         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Tempo de solução</span>
            <div class="count">{{ $sol_media }}</div>
            <span class="count_bottom"><i class="dourado">dias</span>
        </div>
    </div>

   <!-- <div id="sol_total" style="width: 600px;height:400px;"></div> -->






