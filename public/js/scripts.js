$(function(){
    VMasker ($("#cpf")).maskPattern("999.999.999-99");

    //////////////////////////////////// Mapa

    // var mapData = {
    //     "AU": 760,
    //     "BR": 550,
    //     "CA": 120,
    //     "DE": 1300,
    //     "FR": 540,
    //     "GB": 690,
    //     "GE": 200,
    //     "IN": 200,
    //     "RO": 600,
    //     "RU": 300,
    //     "US": 2920,
    // };

    // $('#worldMap').vectorMap({
    //     map: 'world_mill_en',
    //     backgroundColor: "transparent",
    //     zoomOnScroll: false,
    //     regionStyle: {
    //         initial: {
    //             fill: '#e4e4e4',
    //             "fill-opacity": 0.9,
    //             stroke: 'none',
    //             "stroke-width": 0,
    //             "stroke-opacity": 0
    //         }
    //     },

    //     series: {
    //         regions: [{
    //             values: mapData,
    //             scale: ["#AAAAAA","#444444"],
    //             normalizeFunction: 'polynomial'
    //         }]
    //     },
    // });

    //////////////////////////////////////////////////////////////////////////////// Gráficos

    //////////////////////////////////////////////////// Daily Sales

    // dataDailySalesChart = {
    //     labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    //     series: [
    //         [12, 17, 7, 17, 23, 18, 38]
    //     ]
    // };

    // optionsDailySalesChart = {
    //     lineSmooth: Chartist.Interpolation.cardinal({
    //         tension: 0
    //     }),
    //     low: 0,
    //     high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    //     chartPadding: { top: 0, right: 0, bottom: 0, left: 0},
    // }

    // var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

    // var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataDailySalesChart, optionsDailySalesChart);

    // md.startAnimationForLineChart(dailySalesChart);

    //////////////////////////////////////////////////// Website Views

    // var dataWebsiteViewsChart = {
    //   labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
    //   series: [
    //     [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]

    //   ]
    // };
    // var optionsWebsiteViewsChart = {
    //     axisX: {
    //         showGrid: false
    //     },
    //     low: 0,
    //     high: 1000,
    //     chartPadding: { top: 0, right: 5, bottom: 0, left: 0}
    // };
    // var responsiveOptions = [
    //   ['screen and (max-width: 640px)', {
    //     seriesBarDistance: 5,
    //     axisX: {
    //       labelInterpolationFnc: function (value) {
    //         return value[0];
    //       }
    //     }
    //   }]
    // ];
    // var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);

    //start animation for the Emails Subscription Chart
    // md.startAnimationForBarChart(websiteViewsChart);

    //////////////////////////////////////////////////// Completed Tasks

    // dataCompletedTasksChart = {
    //     labels: ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a'],
    //     series: [
    //         [230, 750, 450, 300, 280, 240, 200, 190]
    //     ]
    // };

    // optionsCompletedTasksChart = {
    //     lineSmooth: Chartist.Interpolation.cardinal({
    //         tension: 0
    //     }),
    //     low: 0,
    //     high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    //     chartPadding: { top: 0, right: 0, bottom: 0, left: 0}
    // }

    // var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

    // start animation for the Completed Tasks Chart - Line Chart
    // md.startAnimationForLineChart(completedTasksChart);

   

});