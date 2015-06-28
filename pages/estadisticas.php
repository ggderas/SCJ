<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
        <script>
        vari= $("#realizadasDelMes").val();
        realizadasTotal=$("#realizadasTotal").val();
        faltantesTotal=$("#faltantesTotal").val();
        noRealizadasTotal=$("#noRealizadasTotal").val();
        realizadasMes=$("#realizadasMes").val();
        noRealizadasMes=$("#noRealizadasMes").val();
        faltantesMes=$("#faltantesMes").val();
        realizadasSemana=$("#realizadasSemana").val();
        faltantesSemana=$("#faltantesSemana").val();
        noRealizadasSemana=$("#noRealizadasSemana").val();
        
        $(function() {

    Morris.Donut({
        element: 'morris-donut-chart',
       // data:'estadisticasActDelMes.php',
        data:[{
            label: "Realizadas",
            value: realizadasSemana,
            color:"green"
        }, {
            label: "Pendientes",
            value: faltantesSemana
        }, {
            label: "Incumplidas",
            value: noRealizadasSemana,
            color:"red"
        }],
        resize: true
    });
    
    Morris.Donut({
        element: 'morris-donut-chart2',
       // data:'estadisticasActDelMes.php',
        data:[{
            label: "Realizadas",
            value: realizadasMes,
            color:"green"
        }, {
            label: "Pendientes",
            value: faltantesMes
        }, {
            label: "Incumplidas",
            value: noRealizadasMes,
            color:"red"
        }],
        resize: true
    });
    
     Morris.Donut({
        element: 'morris-donut-chart3',
       // data:'estadisticasActDelMes.php',
        data:[{
            label: "Realizadas",
            value: realizadasTotal,
            color:"green"
        }, {
            label: "Pendientes",
            value: faltantesTotal
        }, {
            label: "Incumplidas",
            value: noRealizadasTotal,
            color:"red"
        }],
        resize: true
    });
    
    
   
    

});
        
        </script>
    </head>
    <body>
        <?php
        include '../Datos/conexion.php';
        //aqui carga las actividades totales Realizadas
$query = mysql_query("select count(actividades.id_actividad) as cantidadR from actividades where year((select fecha from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad ))=year(now()) and actividades.id_actividad in (select actividades_terminadas.id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad )", $enlace);
$row = mysql_fetch_array($query) ;
$cantidadTotalActRealizadas = $row["cantidadR"];

//aqui carga las actividades totales faltantes 
$query = mysql_query("select count(id_actividad) as cantidadF from actividades where year(now()) between year(fecha_inicio) and year(fecha_fin)  
and id_actividad not in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad )
and actividades.fecha_fin >= now()", $enlace);
$row = mysql_fetch_array($query);
$cantidadTotalActFaltantes = $row["cantidadF"];

//aqui carga las actividades totales que no se realizaron
$query = mysql_query("select count(id_actividad) as cantidadNR from actividades where year(now()) between year(fecha_inicio) and year(fecha_fin)  
and id_actividad not in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad )
and actividades.fecha_fin < now()", $enlace);
$row = mysql_fetch_array($query);
$cantidadTotalActNoRealizadas = $row["cantidadNR"];


//aqui carga las actividades del mes que se realizaron
$query = mysql_query("select count(id_actividad) as cantidadRM from actividades where month(actividades.fecha_fin)=month(now()) and id_actividad in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= id_actividad )", $enlace);
$row = mysql_fetch_array($query);
$cantidadMesRealizadas = $row["cantidadRM"];

//aqui carga las actividades del mes NO se realizaron
$query = mysql_query("select count(id_actividad) as cantidadRNM from actividades where month(now()) = month(actividades.fecha_fin)  
and id_actividad not in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad )
and actividades.fecha_fin < now()", $enlace);
$row = mysql_fetch_array($query);
$cantidadMesNORealizadas = $row["cantidadRNM"];


//aqui carga las actividades del mes que faltan
$query = mysql_query("select count(id_actividad) as cantidadMF from actividades where month(now()) = month(actividades.fecha_fin) and id_actividad not in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad ) and actividades.fecha_fin >= now()", $enlace);
$row = mysql_fetch_array($query);
$cantidadMesfaltantes = $row["cantidadMF"];

//aqui carga las actividades realizadas en la semana
$query = mysql_query("select count(id_actividad) as cantidadSR from actividades where week(actividades.fecha_fin)=week(now()) and id_actividad in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= id_actividad )", $enlace);
$row = mysql_fetch_array($query);
$cantidadSemanaRealizadas = $row["cantidadSR"];

//aqui carga las actividades faltantes en la semana
$query = mysql_query("select count(id_actividad) as cantidadSF from actividades where week(now()) = week(actividades.fecha_fin) and id_actividad not in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad ) and actividades.fecha_fin >= now()", $enlace);
$row = mysql_fetch_array($query);
$cantidadSemanafaltantes = $row["cantidadSF"];

//aqui carga las actividades que no se Cumplieron en la semana
$query = mysql_query("select count(id_actividad) as cantidadSNR from actividades where week(now()) = week(actividades.fecha_fin) and id_actividad not in (select id_Actividad from actividades_terminadas where actividades_terminadas.id_Actividad= actividades.id_actividad ) and actividades.fecha_fin < now()", $enlace);
$row = mysql_fetch_array($query);
$cantidadSemanaNORealizadas = $row["cantidadSNR"];



        ?>
        <input id="realizadasDelMes" type="hidden" value="15" >
        <input id="realizadasTotal" type="hidden" value="<?php echo $cantidadTotalActRealizadas; ?>" >
        <input id="faltantesTotal" type="hidden" value="<?php echo $cantidadTotalActFaltantes; ?>" >
        <input id="noRealizadasTotal" type="hidden" value="<?php echo $cantidadTotalActNoRealizadas; ?>" >
        <input id="noRealizadasMes" type="hidden" value="<?php echo $cantidadMesNORealizadas ; ?>" >
        <input id="realizadasMes" type="hidden" value="<?php echo $cantidadMesRealizadas; ?>" >
        <input id="faltantesMes" type="hidden" value="<?php echo $cantidadMesfaltantes; ?>" >
        <input id="realizadasSemana" type="hidden" value="<?php echo $cantidadSemanaRealizadas ?>" >
        <input id="faltantesSemana" type="hidden" value="<?php echo $cantidadSemanafaltantes; ?>" >
        <input id="noRealizadasSemana" type="hidden" value="<?php echo $cantidadSemanaNORealizadas ; ?>" >
        <div id="wrapper">

            <div class="col-lg-12">
                <h1 class="page-header">Estadisticas</h1>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Actividades De la Semana
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Actividades Del Mes
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Actividades
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
   
</html>
