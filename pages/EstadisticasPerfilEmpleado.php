
<html lang="es">
    <head>
        <script>
        
        realizadasTotal=$("#realizadasTotal").val();
        faltantesTotal=$("#faltantesTotal").val();
        noRealizadasTotal=$("#noRealizadasTotal").val();
    
        
        $(function() {
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
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_GET['contenido'])) {
    $contenido = $_GET['contenido'];
} else {
    $contenido = 'poa';
}


if (isset($_SESSION['user_id'])) {
    $id_Usuario = $_SESSION['user_id'];
}

if (isset($_SESSION['nombreUsuario'])) {
    $usuario = $_SESSION['nombreUsuario'];
}


require_once("../funciones/check_session.php");

require_once("../funciones/timeout.php");

include '../Datos/conexion.php';

if (isset($_SESSION['user_id'])) {
    $id_Usuario = $_SESSION['user_id'];
}
$consulta = mysql_query("select usuario.No_Empleado from usuario where usuario.id_Usuario=" . $id_Usuario . "", $enlace);

while ($nro_Emp = mysql_fetch_array($consulta)) {
    $nroEmpleado = $nro_Emp['No_Empleado'];
}
        //aqui carga las sub-actividades realizadas
$query = mysql_query('select count(id_sub_Actividad) as subActividadesR from sub_actividad where (id_Encargado="'.$nroEmpleado.'") and (year(now())=year(fecha_monitoreo)) and (sub_actividad.id_sub_Actividad in (select id_SubActividad from sub_actividades_realizadas where sub_actividades_realizadas.id_SubActividad = sub_actividad.id_sub_Actividad))', $enlace);
$row = mysql_fetch_array($query) ;
$cantidadTotalActRealizadas = $row["subActividadesR"];

//aqui carga las sub-actividades faltantes
$query = mysql_query('select count(sub_actividad.id_sub_Actividad) as subActividadesNR from sub_actividad where (sub_actividad.id_Encargado="'.$nroEmpleado.'") and (year(now())=year(fecha_monitoreo)) and fecha_monitoreo >= now() and sub_actividad.id_sub_Actividad not in (select sub_actividades_realizadas.id_SubActividad from sub_actividades_realizadas where sub_actividades_realizadas.id_SubActividad = sub_actividad.id_sub_Actividad )',$enlace);
$row = mysql_fetch_array($query);
$cantidadTotalActFaltantes = $row["subActividadesNR"];

//aqui carga las sub-actividadesque no se realizaron
$query = mysql_query('select count(sub_actividad.id_sub_Actividad) as subActividadesFR from sub_actividad where (sub_actividad.id_Encargado="'.$nroEmpleado.'") and (year(now())=year(fecha_monitoreo)) and fecha_monitoreo < now() and sub_actividad.id_sub_Actividad not in (select sub_actividades_realizadas.id_SubActividad from sub_actividades_realizadas where sub_actividades_realizadas.id_SubActividad = sub_actividad.id_sub_Actividad )', $enlace);
$row = mysql_fetch_array($query);
$cantidadTotalActNoRealizadas = $row["subActividadesFR"];




        ?>
        <input id="realizadasDelMes" type="hidden" value="15" >
        <input id="realizadasTotal" type="hidden" value="<?php echo $cantidadTotalActRealizadas; ?>" >
        <input id="faltantesTotal" type="hidden" value="<?php echo $cantidadTotalActFaltantes; ?>" >
        <input id="noRealizadasTotal" type="hidden" value="<?php echo $cantidadTotalActNoRealizadas; ?>" >
        <div id="wrapper">

            <div class="col-lg-12">
                <h1 class="page-header">Estadisticas</h1>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Total Sub-Actividades:   <?php echo ($cantidadTotalActRealizadas+$cantidadTotalActFaltantes+ $cantidadTotalActNoRealizadas);?>
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
