$(function() {

    Morris.Donut({
        element: 'morris-donut-chart',
        data:"estadisticasActDelMes.php",
//        data:[{
//            label: "Realizadas",
//            value: 12
//        }, {
//            label: "Pendientes",
//            value: 30
//        }, {
//            label: "Incumplidas",
//            value: 20
//        }],
        resize: true
    });

});
