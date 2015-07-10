
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
$query = mysql_query('select count(ID_Grupo_o_comite) as divisor from grupo_o_comite_has_empleado where No_Empleado="'.$nroEmpleado.'"', $enlace);
$row = mysql_fetch_array($query);
$divisor = $row["divisor"];
        //aqui carga las sub-actividades realizadas
$query =mysql_query('select count( actividades.id_actividad) as cantidad
from actividades
inner join actividades_terminadas on actividades.id_actividad = actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades_terminadas.id_Actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmpleado.'"', $enlace);
$row = mysql_fetch_array($query) ;
@$cantidadTotalActRealizadas = ($row["cantidad"])/$divisor;

//aqui carga las sub-actividades faltantes
$query = mysql_query('select count( actividades.id_actividad) as cantidad
from actividades
inner join actividades_terminadas  on actividades.id_actividad <> actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades.id_actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmpleado.'"
where actividades.id_actividad <> actividades_terminadas.id_Actividad and year(fecha_fin)= year(now()) and fecha_fin>now()',$enlace);
$row = mysql_fetch_array($query);
@$cantidadTotalActFaltantes = ($row["cantidad"])/$divisor;

//aqui carga las sub-actividadesque no se realizaron
$query = mysql_query('select count( actividades.id_actividad) as cantidad
from actividades
inner join actividades_terminadas  on actividades.id_actividad <> actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades.id_actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmpleado.'"
where actividades.id_actividad <> actividades_terminadas.id_Actividad and year(fecha_fin)= year(now()) and fecha_fin<now()',$enlace);
$row = mysql_fetch_array($query);
@$cantidadTotalActNoRealizadas = ($row["cantidad"])/$divisor;




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
                            Total Actividades:   <?php echo ($cantidadTotalActRealizadas+$cantidadTotalActFaltantes+ $cantidadTotalActNoRealizadas);?>
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
