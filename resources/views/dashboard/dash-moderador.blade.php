@extends('layouts.material')

@section('titulo')
Painel
@endsection

@section('content')

   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-header-icon" data-background-color="green" style="color: #fff;">
               <i class="material-icons">dashboard</i>
            </div>
            <div class="card-content">
               <h4 class="card-title">Painel de informações</h4>
         </div>



         <div class="row">
            <div class="col-md-4">
                <div class="card card-chart" data-count="1">
                    <div class="card-header" data-background-color="rose" data-header-animation="true">
                        <div class="ct-chart" id="websiteViewsChart">
                           <svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;">
                              <g class="ct-grids">
                                 <line y1="120" y2="120" x1="40" x2="286" class="ct-grid ct-vertical"></line>
                                 <line y1="96"  y2="96"  x1="40" x2="286" class="ct-grid ct-vertical"></line>
                                 <line y1="72"  y2="72"  x1="40" x2="286" class="ct-grid ct-vertical"></line>
                                 <line y1="48"  y2="48"  x1="40" x2="286" class="ct-grid ct-vertical"></line>
                                 <line y1="24"  y2="24"  x1="40" x2="286" class="ct-grid ct-vertical"></line>
                                 <line y1="0"   y2="0"   x1="40" x2="286" class="ct-grid ct-vertical"></line>
                              </g>
                              <g>
                                 <g class="ct-series ct-series-a">
                                    <line x1="50.25"  x2="50.25"  y1="120" y2="54.959999999999994" class="ct-bar" ct:value="542" opacity="1"></line> <line x1="70.75"  x2="70.75"  y1="120" y2="66.84" class="ct-bar" ct:value="443" opacity="1"></line>
                                    <line x1="91.25"  x2="91.25"  y1="120" y2="81.6" class="ct-bar" ct:value="320" opacity="1"></line>
                                    <line x1="111.75" x2="111.75" y1="120" y2="26.400000000000006" class="ct-bar" ct:value="780" opacity="1"></line>
                                    <line x1="132.25" x2="132.25" y1="120" y2="53.64" class="ct-bar" ct:value="553" opacity="1"></line>
                                    <line x1="152.75" x2="152.75" y1="120" y2="65.64" class="ct-bar" ct:value="453" opacity="1"></line>
                                    <line x1="173.25" x2="173.25" y1="120" y2="80.88" class="ct-bar" ct:value="326" opacity="1"></line>
                                    <line x1="193.75" x2="193.75" y1="120" y2="67.92" class="ct-bar" ct:value="434" opacity="1"></line>
                                    <line x1="214.25" x2="214.25" y1="120" y2="51.84" class="ct-bar" ct:value="568" opacity="1"></line>
                                    <line x1="234.75" x2="234.75" y1="120" y2="46.8" class="ct-bar" ct:value="610" opacity="1"></line>
                                    <line x1="255.25" x2="255.25" y1="120" y2="29.28" class="ct-bar" ct:value="756" opacity="1"></line>
                                    <line x1="275.75" x2="275.75" y1="120" y2="12.599999999999994" class="ct-bar" ct:value="895" opacity="1"></line>
                                 </g>
                              </g>
                              <g class="ct-labels">
                                 <foreignObject style="overflow: visible;" x="40" y="125" width="20.5" height="20">
                                    <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">J
                                    </span>
                                 </foreignObject>
                                 <foreignObject style="overflow: visible;" x="60.5" y="125" width="20.5" height="20">
                                    <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">F
                                    </span>
                                 </foreignObject>
                                 <foreignObject style="overflow: visible;" x="81" y="125" width="20.5" height="20">
                                    <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">M
                                    </span>
                                 </foreignObject>
                                 <foreignObject style="overflow: visible;" x="101.5" y="125" width="20.5" height="20">
                                    <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">A
                                    </span>
                                 </foreignObject>
                                 <foreignObject style="overflow: visible;" x="122" y="125" width="20.5" height="20">
                                    <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">M
                                    </span>
                                 </foreignObject>
                                 <foreignObject style="overflow: visible;" x="142.5" y="125" width="20.5" height="20">
                                    <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">J
                                    </span>
                                 </foreignObject><foreignObject style="overflow: visible;" x="163" y="125" width="20.5" height="20">
                                    <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">J
                                 </span>
                              </foreignObject>
                              <foreignObject style="overflow: visible;" x="183.5" y="125" width="20.5" height="20">
                                 <span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">A</span></foreignObject><foreignObject style="overflow: visible;" x="204" y="125" width="20.5" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">S</span></foreignObject><foreignObject style="overflow: visible;" x="224.5" y="125" width="20.5" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">O</span></foreignObject><foreignObject style="overflow: visible;" x="245" y="125" width="20.5" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 21px; height: 20px;">N</span></foreignObject><foreignObject style="overflow: visible;" x="265.5" y="125" width="30" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 30px; height: 20px;">D</span></foreignObject><foreignObject style="overflow: visible;" y="96" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="72" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">200</span></foreignObject><foreignObject style="overflow: visible;" y="48" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">400</span></foreignObject><foreignObject style="overflow: visible;" y="24" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">600</span></foreignObject><foreignObject style="overflow: visible;" y="0" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">800</span></foreignObject><foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">1000</span></foreignObject></g></svg></div>
                    </div>
                    <div class="card-content">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>
                            <button type="button" class="btn btn-info btn-simple" rel="tooltip" data-placement="bottom" title="" data-original-title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="" data-original-title="Change Date">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <h4 class="card-title">Solicitações criadas</h4>
                        <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-chart" data-count="1">
                    <div class="card-header" data-background-color="green" data-header-animation="true">
                        <div class="ct-chart" id="dailySalesChart"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line x1="40" x2="40" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="75.85714285714286" x2="75.85714285714286" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="111.71428571428571" x2="111.71428571428571" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="147.57142857142856" x2="147.57142857142856" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="183.42857142857142" x2="183.42857142857142" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="219.28571428571428" x2="219.28571428571428" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="255.1428571428571" x2="255.1428571428571" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line y1="120" y2="120" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="96" y2="96" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="72" y2="72" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="48" y2="48" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="24" y2="24" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="0" y2="0" x1="40" x2="291" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M 40 91.2 C 75.857 79.2 75.857 79.2 75.857 79.2 C 111.714 103.2 111.714 103.2 111.714 103.2 C 147.571 79.2 147.571 79.2 147.571 79.2 C 183.429 64.8 183.429 64.8 183.429 64.8 C 219.286 76.8 219.286 76.8 219.286 76.8 C 255.143 28.8 255.143 28.8 255.143 28.8" class="ct-line"></path><line x1="40" y1="91.2" x2="40.01" y2="91.2" class="ct-point" ct:value="12" opacity="1"></line><line x1="75.85714285714286" y1="79.2" x2="75.86714285714287" y2="79.2" class="ct-point" ct:value="17" opacity="1"></line><line x1="111.71428571428571" y1="103.2" x2="111.72428571428571" y2="103.2" class="ct-point" ct:value="7" opacity="1"></line><line x1="147.57142857142856" y1="79.2" x2="147.58142857142855" y2="79.2" class="ct-point" ct:value="17" opacity="1"></line><line x1="183.42857142857142" y1="64.8" x2="183.4385714285714" y2="64.8" class="ct-point" ct:value="23" opacity="1"></line><line x1="219.28571428571428" y1="76.8" x2="219.29571428571427" y2="76.8" class="ct-point" ct:value="18" opacity="1"></line><line x1="255.1428571428571" y1="28.799999999999997" x2="255.1528571428571" y2="28.799999999999997" class="ct-point" ct:value="38" opacity="1"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="40" y="125" width="35.857142857142854" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 36px; height: 20px;">M</span></foreignObject><foreignObject style="overflow: visible;" x="75.85714285714286" y="125" width="35.857142857142854" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 36px; height: 20px;">T</span></foreignObject><foreignObject style="overflow: visible;" x="111.71428571428571" y="125" width="35.85714285714285" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 36px; height: 20px;">W</span></foreignObject><foreignObject style="overflow: visible;" x="147.57142857142856" y="125" width="35.85714285714286" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 36px; height: 20px;">T</span></foreignObject><foreignObject style="overflow: visible;" x="183.42857142857142" y="125" width="35.85714285714286" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 36px; height: 20px;">F</span></foreignObject><foreignObject style="overflow: visible;" x="219.28571428571428" y="125" width="35.85714285714283" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 36px; height: 20px;">S</span></foreignObject><foreignObject style="overflow: visible;" x="255.1428571428571" y="125" width="35.85714285714289" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 36px; height: 20px;">S</span></foreignObject><foreignObject style="overflow: visible;" y="96" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="72" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">10</span></foreignObject><foreignObject style="overflow: visible;" y="48" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">20</span></foreignObject><foreignObject style="overflow: visible;" y="24" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">30</span></foreignObject><foreignObject style="overflow: visible;" y="0" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">40</span></foreignObject><foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">50</span></foreignObject></g></svg></div>
                    </div>
                    <div class="card-content">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>
                            <button type="button" class="btn btn-info btn-simple" rel="tooltip" data-placement="bottom" title="" data-original-title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="" data-original-title="Change Date">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <h4 class="card-title">Daily Sales</h4>
                        <p class="category">
                            <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-chart" data-count="1">
                    <div class="card-header" data-background-color="blue" data-header-animation="true">
                        <div class="ct-chart" id="completedTasksChart"><svg xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-line" style="width: 100%; height: 100%;"><g class="ct-grids"><line x1="40" x2="40" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="71.375" x2="71.375" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="102.75" x2="102.75" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="134.125" x2="134.125" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="165.5" x2="165.5" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="196.875" x2="196.875" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="228.25" x2="228.25" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line x1="259.625" x2="259.625" y1="0" y2="120" class="ct-grid ct-horizontal"></line><line y1="120" y2="120" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="96" y2="96" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="72" y2="72" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="48" y2="48" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="24" y2="24" x1="40" x2="291" class="ct-grid ct-vertical"></line><line y1="0" y2="0" x1="40" x2="291" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><path d="M 40 92.4 C 71.375 30 71.375 30 71.375 30 C 102.75 66 102.75 66 102.75 66 C 134.125 84 134.125 84 134.125 84 C 165.5 86.4 165.5 86.4 165.5 86.4 C 196.875 91.2 196.875 91.2 196.875 91.2 C 228.25 96 228.25 96 228.25 96 C 259.625 97.2 259.625 97.2 259.625 97.2" class="ct-line"></path><line x1="40" y1="92.4" x2="40.01" y2="92.4" class="ct-point" ct:value="230" opacity="1"></line><line x1="71.375" y1="30" x2="71.385" y2="30" class="ct-point" ct:value="750" opacity="1"></line><line x1="102.75" y1="66" x2="102.76" y2="66" class="ct-point" ct:value="450" opacity="1"></line><line x1="134.125" y1="84" x2="134.135" y2="84" class="ct-point" ct:value="300" opacity="1"></line><line x1="165.5" y1="86.4" x2="165.51" y2="86.4" class="ct-point" ct:value="280" opacity="1"></line><line x1="196.875" y1="91.2" x2="196.885" y2="91.2" class="ct-point" ct:value="240" opacity="1"></line><line x1="228.25" y1="96" x2="228.26" y2="96" class="ct-point" ct:value="200" opacity="1"></line><line x1="259.625" y1="97.2" x2="259.635" y2="97.2" class="ct-point" ct:value="190" opacity="1"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="40" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">12p</span></foreignObject><foreignObject style="overflow: visible;" x="71.375" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">3p</span></foreignObject><foreignObject style="overflow: visible;" x="102.75" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">6p</span></foreignObject><foreignObject style="overflow: visible;" x="134.125" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">9p</span></foreignObject><foreignObject style="overflow: visible;" x="165.5" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">12p</span></foreignObject><foreignObject style="overflow: visible;" x="196.875" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">3a</span></foreignObject><foreignObject style="overflow: visible;" x="228.25" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">6a</span></foreignObject><foreignObject style="overflow: visible;" x="259.625" y="125" width="31.375" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 31px; height: 20px;">9a</span></foreignObject><foreignObject style="overflow: visible;" y="96" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="72" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">200</span></foreignObject><foreignObject style="overflow: visible;" y="48" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">400</span></foreignObject><foreignObject style="overflow: visible;" y="24" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">600</span></foreignObject><foreignObject style="overflow: visible;" y="0" x="0" height="24" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 24px; width: 30px;">800</span></foreignObject><foreignObject style="overflow: visible;" y="-30" x="0" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">1000</span></foreignObject></g></svg></div>
                    </div>
                    <div class="card-content">
                        <div class="card-actions">
                            <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                <i class="material-icons">build</i> Fix Header!
                            </button>
                            <button type="button" class="btn btn-info btn-simple" rel="tooltip" data-placement="bottom" title="" data-original-title="Refresh">
                                <i class="material-icons">refresh</i>
                            </button>
                            <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="" data-original-title="Change Date">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <h4 class="card-title">Completed Tasks</h4>
                        <p class="category">Last Campaign Performance</p>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i> campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>






      </div>
   </div>

@endsection


@push('scripts')

   <script type="text/javascript">
  
   </script>
@endpush




