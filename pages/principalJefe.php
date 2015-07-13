<?php
$maindir = "../";
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


require_once($maindir . "funciones/check_session.php");

require_once($maindir . "funciones/timeout.php");

require_once($maindir . "pages/navbar.php");

include '../Datos/conexion.php';

if (isset($_SESSION['user_id'])) {
    $id_Usuario = $_SESSION['user_id'];
}
$consulta = mysql_query("select usuario.No_Empleado from usuario where usuario.id_Usuario=" . $id_Usuario . "", $enlace);

while ($nro_Emp = mysql_fetch_array($consulta)) {
    $nroEmpleado = $nro_Emp['No_Empleado'];
}


//$consultaActividadesPasadas = mysql_query('SELECT * FROM sub_actividad WHERE fecha_monitoreo< curdate() and id_Encargado="' . $nroEmpleado . '" order by fecha_monitoreo asc', $enlace);
$consultaActividadesPasadas= mysql_query('select distinct actividades.id_actividad, actividades.descripcion, actividades.correlativo, actividades.fecha_inicio,actividades.fecha_fin
from actividades
inner join actividades_terminadas  on actividades.id_actividad <> actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades.id_actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmpleado.'"
where actividades.id_actividad <> actividades_terminadas.id_Actividad and year(fecha_fin)= year(now()) and fecha_fin<now()',$enlace);

$consultaActividadesFalt= mysql_query('select distinct actividades.id_actividad, actividades.descripcion, actividades.correlativo, actividades.fecha_inicio,actividades.fecha_fin
from actividades
inner join actividades_terminadas  on actividades.id_actividad <> actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades.id_actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmpleado.'"
where actividades.id_actividad <> actividades_terminadas.id_Actividad and year(fecha_fin)= year(now()) and fecha_fin>now()',$enlace);
        
$consultaActiviadesRealizadas = mysql_query('select distinct actividades.id_actividad, actividades_terminadas.fecha, grupo_o_comite.Nombre_Grupo_o_comite as comite, actividades.descripcion
from actividades
inner join actividades_terminadas on actividades.id_actividad = actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades_terminadas.id_Actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmpleado.'"', $enlace);
?>

<!doctype html>
<html lang="es">
    <head></head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">                
                    <a class="navbar-brand" href="#">Actividades</a>
                </div>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu" >
                            <li>
                                <a id="AsignarsubActividades" href="#" data-target=".dashboard-menu" class="nav-header collapsed" data-toggle="collapse"><i class="glyphicon glyphicon-list"></i>Asignar Sub-Actividad<i class="fa fa-collapse"></i></a>
                            </li>
                            <li>
                                <a id="estadisticas" href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Estadisticas</a>
                            </li>
                            <li>
                                <a  id="perfilUsuarioFinal" href="#"><i class="fa fa-user"></i>Mi Perfil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        
        <div id="page-wrapper" >
            <div class="col-lg-12">
                <div id="contenedor" class="panel panel-primary">
                    <div  id="contenedorUsuarios" class="panel panel-body" >
                        <div class="panel panel-heading">
                        <h2>Bienvenido <?php echo $usuario; ?> Este es el resumen de sus actividades</h2>
                        </div>
                        <div class="col-lg-1"></div>
                         <div class="col-lg-12" class="center center-block">
                        <div class="col-lg-12" class="center center-block">
                          <div class="box-body table-responsive panel panel-red">
                                    <div class="panel-heading">
                               Actividades Pasadas 
                                    </div>
                            <table id="ActPasadas"  class='table table-bordered table-striped'>
                                <thead class="panel panel-red">
                                    <tr>
                                    <th>Id Actividad</th>
                                    <th>Descripcion</th>
                                    <th>Correlativo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    </tr>
                                </thead>
                                <div class="panel-body panel-red"></div>
                            <tbody>
                                <?php
/*$i=0; */                                //$contador = 0;
                                    while ($filaAU = mysql_fetch_array($consultaActividadesPasadas)) {
                                        ?>
                                <tr>
                                <td><div class="col-lg-1" class="text" id="id-<?php echo $id ?>"><?php echo $filaAU['id_actividad'] ?></div></td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $filaAU['descripcion'] ?></div></td>
                                <td><div class="text" id="id_Act-<?php echo $id ?>"><?php echo $filaAU['correlativo'] ?></div></td>
                                <td><div class="text" id="fecha-<?php echo $id ?>"><?php echo $filaAU['fecha_inicio'] ?></div></td>
                                <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $filaAU['fecha_fin'] ?></div></td>
                                </tr>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                           
                            </table>   
                               <?php
                             echo "<a href='pages/reporteActividadesnoRealizadaspdf.php?a=$nroEmpleado' target=_blank>Generar Reporte</a>"
                                                ?>
                         </div> 
                       </div>
                         
                         <div class="col-lg-12" class="center center-block">
                          <div class="box-body table-responsive panel panel-success">
                                    <div class="panel-heading">
                               Actividades Realizadas
                                    </div>
                    
                            <table id="ActRealizada"  class='table table-bordered table-striped'>
                                <thead class="panel panel-green">
                                    <tr>
                                    <th>Id Actividad</th>
                                    <th>Fecha Culminacion</th>
                                    <th>Comite</th>
                                    <th>Descripcion</th>
                                 
                                    </tr>
                                </thead>
                                <div class="panel-body panel-green"></div>
                            <tbody>
                                <?php
/*$i=0; */                              //  $contador = 0;
                                    while ($filaAU = mysql_fetch_array($consultaActiviadesRealizadas)) {
                                       
                                        ?>
                                <tr>
                                
                                <td><?php echo $filaAU['id_actividad'] ?></td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $filaAU['fecha'] ?></div></td>
                                <td><div class="text" id="id_Act-<?php echo $id ?>"><?php echo $filaAU['comite'] ?></div></td>
                                <td><?php echo $filaAU['descripcion'] ?></td>
                                                    
                                </tr>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                         
                            </table>  
                              <?php
                             echo "<a href='pages/reporteActividadesRealizadaspdf.php?a=$nroEmpleado' target=_blank>Generar Reporte</a>"
                                                ?>
                         </div> 
                       </div>     
                             
                       <div class="col-lg-12" class="center center-block">
                          <div class="box-body table-responsive panel panel-green">
                                    <div class="panel-heading">
                               Actividades Faltantes
                                    </div>
                    
                            <table id="ActFutura"  class='table table-bordered table-striped'>
                                <thead class="panel panel-green">
                                    <tr>
                                    <th>Finalizar</th>
                                    <th>Id Actividad</th>
                                    <th>Descripcion</th>
                                    <th>Correlativo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    </tr>
                                </thead>
                                <div class="panel-body panel-green"></div>
                            <tbody>
                                <?php
/*$i=0; */                              //  $contador = 0;
                                    while ($filaAU = mysql_fetch_array($consultaActividadesFalt)) {
                                       
                                        ?>
                                <tr>
                                <td><button id="finalizar" type="button" class="btn btn-success "><i class="fa fa-check"></i> </button></td>
                                <td><?php echo $filaAU['id_actividad'] ?></td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $filaAU['descripcion'] ?></div></td>
                                <td><div class="text" id="id_Act-<?php echo $id ?>"><?php echo $filaAU['correlativo'] ?></div></td>
                                <td><?php echo $filaAU['fecha_inicio'] ?></td>
                                <td><?php echo $filaAU['fecha_fin'] ?></td>                     
                                </tr>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                         
                            </table>  
                              <?php
                             echo "<a href='pages/reporteActividadesFaltantespdf.php?a=$nroEmpleado' target=_blank>Generar Reporte</a>"
                                                ?>
                         </div> 
                       </div>
                             
                         </div>
                    </div>
                </div>
            </div>
        </div>
        
      <div class="modal fade" id="ActividadRealizada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Finalizar Sub Actividad</h4>
                </div>
                <div class="modal-body" id="CuerpoSubActividadRealizada">
                    
                </div>

            </div>
        </div>
    </div>
    </body>
         
       <script type="text/javascript">

$(document).ready(function() {
    $('#ActRealizada').dataTable({
	    "order": [[ 0, "asc" ]],
	    "fnDrawCallback": function( oSettings ) {	
		}
	}); // example es el id de la tabla
});
 
</script>
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#ActRealizada')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#AsignarsubActividades").click(function() {
                $("#contenedorUsuarios").load('pages/AsignarSubActividadPerfilJefe.php');
            });
            
        });      
    </script>
    
    <script type="text/javascript">

$(document).ready(function() {
    $('#ActPasadas').dataTable({
	    "order": [[ 0, "asc" ]],
	    "fnDrawCallback": function( oSettings ) {	
		}
	}); // example es el id de la tabla
});
 
</script>
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#ActPasadas')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>

   <script type="text/javascript">

$(document).ready(function() {
    $('#ActFutura').dataTable({
	    "order": [[ 0, "asc" ]],
	    "fnDrawCallback": function( oSettings ) {	
		}
	}); // example es el id de la tabla
});
 
</script>
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#ActFutura')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>
<script type="text/javascript">
    
     $(document).ready(function() {

                    $("#estadisticas").click(function() {
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            //: "application/x-www-form-urlencoded",
                            //url: "pages/editarPOA.php",
                            //beforeSend: inicioEliminar,
                            success: llegadaFinalizarEstadisticas,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;

                    });


                });

                function llegadaFinalizarEstadisticas()
                {  
                    //alert("culo");
                   $("#contenedorUsuarios").load('pages/EstadisticasPerfilJefe.php');                   
                    //$("#ActividadRealizada").modal('show');                  
                }

                function problemas()
                {
                    $("#contenedorUsuarios").text('Problemas en el servidor.');
                }
</script>
<script type="text/javascript">

                $(document).ready(function() {

                    $("#finalizar").click(function() {
                        id = $(this).parents("tr").find("td").eq(1).html();
                        //alert(id);      
                        data = {
                            idAct: id
                        };
                        $.ajax({
                            async: true,
                            type: "POST",
                            dataType: "html",
                            //: "application/x-www-form-urlencoded",
                            //url: "pages/editarPOA.php",
                            //beforeSend: inicioEliminar,
                            success: llegadaFinalizarSubActividad,
                            timeout: 4000,
                            error: problemas
                        });
                        return false;

                    });


                });

                function llegadaFinalizarSubActividad()
                {  
                    $("#CuerpoSubActividadRealizada").load('pages/activiadadRealizadaPerfilJefe.php', data);                   
                    $("#ActividadRealizada").modal('show');                  
                }

                function problemas()
                {
                    $("#contenedor").text('Problemas en el servidor.');
                }
            </script>
</html>