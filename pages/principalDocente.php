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
$consultaActividadesPasadas= mysql_query('SELECT * FROM sub_actividad WHERE ((fecha_monitoreo < curdate())and (year(fecha_monitoreo)=year(now())) and (id_Encargado="'.$nroEmpleado.'") and id_sub_Actividad not in (select id_SubActividad from sub_actividades_realizadas where id_SubActividad=sub_actividad.id_sub_Actividad)) order by fecha_monitoreo asc',$enlace);
$consultaActividadesHoy = mysql_query('SELECT * FROM sub_actividad WHERE `fecha_monitoreo` = curdate() and (year(fecha_monitoreo)=year(now())) and  id_Encargado="' . $nroEmpleado . '"  and id_sub_Actividad not in (select id_SubActividad from sub_actividades_realizadas where id_SubActividad=sub_actividad.id_sub_Actividad) order by `fecha_monitoreo`asc', $enlace);
$consultaActiviadesVenideras = mysql_query('SELECT * FROM sub_actividad WHERE `fecha_monitoreo` > curdate() and (year(fecha_monitoreo)=year(now())) and id_Encargado="' . $nroEmpleado . '" and id_sub_Actividad not in (select id_SubActividad from sub_actividades_realizadas where id_SubActividad=sub_actividad.id_sub_Actividad) order by `fecha_monitoreo`asc', $enlace);
?>

<!doctype html>
<html lang="es">
    <head></head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">                
                    <a class="navbar-brand" href="#">Sub Actividades</a>
                </div>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu" >
                            <li>
                                <a id="subActividades" href="#" data-target=".dashboard-menu" class="nav-header collapsed" data-toggle="collapse"><i class="glyphicon glyphicon-list"></i>Reportes Sub-Actividades<i class="fa fa-collapse"></i></a>
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
                               Sub Actividades Pasadas 
                                    </div>
                            <table id="ActPasadas"  class='table table-bordered table-striped'>
                                <thead class="panel panel-red">
                                    <tr>
                                    <th>id_Sub_Actividad</th>
                                    <th>Nombre</th>
                                    <th>id_Actividad</th>
                                    <th>Fecha Monitoreo</th>
                                    <th>Descripcion</th>
                                  
                                    </tr>
                                </thead>
                                <div class="panel-body panel-red"></div>
                            <tbody>
                                <?php
/*$i=0; */                                //$contador = 0;
                                    while ($filaAU = mysql_fetch_array($consultaActividadesPasadas)) {
                                        ?>
                                <tr>
                                <td><div class="col-lg-1" class="text" id="id-<?php echo $id ?>"><?php echo $filaAU['id_sub_Actividad'] ?></div></td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $filaAU['nombre'] ?></div></td>
                                <td><div class="text" id="id_Act-<?php echo $id ?>"><?php echo $filaAU['idActividad'] ?></div></td>
                                <td><div class="text" id="fecha-<?php echo $id ?>"><?php echo $filaAU['fecha_monitoreo'] ?></div></td>
                                <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $filaAU['descripcion'] ?></div></td>
                                </tr>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                            
                            </table>   
                         </div> 
                       </div>
                       
                         <div class="col-lg-12" class="center center-block">
                          <div class="box-body table-responsive panel panel-yellow">
                                    <div class="panel-heading">
                               Sub Actividades para Hoy 
                                    </div>
                    
                            <table id="ActHoy"  class='table table-bordered table-striped'>
                                <thead class="panel panel-yellow">
                                    <tr>
                                    <th>Finalizar</th>
                                    <th>id_Sub_Actividad</th>
                                    <th>Nombre</th>
                                    <th>id_Actividad</th>
                                    <th>Fecha Monitoreo</th>
                                    <th>Descripcion</th>
                                    
           
                                    </tr>
                                </thead>
                                <div class="panel-body panel-yellow"></div>
                            <tbody>
                                <?php
/*$i=0; */                               // $contador = 0;
                                    while ($filaAU2 = mysql_fetch_array($consultaActividadesHoy)) {
                                        $id= $filaAU2['id_sub_Actividad'];
                                        $id_Act = $filaAU2['idActividad'];
                                        ?>
                                <tr>
                                 <td> <button id="finalizar" type="button" class="btn btn-success "><i class="fa fa-check"></i></button></td>    
                                <td><?php echo $filaAU2['id_sub_Actividad'] ?> </td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $filaAU2['nombre'] ?></div></td>
                                <td><?php echo $filaAU2['idActividad'] ?></td>
                                <td><div class="text" id="fecha-<?php echo $id ?>"><?php echo $filaAU2['fecha_monitoreo'] ?></div></td>
                                <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $filaAU2['descripcion'] ?></div></td>
                                </tr>
                                        <?php
                                    }
                                    ?>
                            </tbody>
                            
                            </table>   
                         </div> 
                       </div>
                            
                
                           
                       <div class="col-lg-12" class="center center-block">
                          <div class="box-body table-responsive panel panel-green">
                                    <div class="panel-heading">
                               Sub Actividades Futuras 
                                    </div>
                    
                            <table id="ActFutura"  class='table table-bordered table-striped'>
                                <thead class="panel panel-green">
                                    <tr>
                                    <th>Finalizar</th>
                                    <th>id_Sub_Actividad</th>
                                    <th>Nombre</th>
                                    <th>id_Actividad</th>
                                    <th>Fecha Monitoreo</th>
                                    <th>Descripcion</th>                               
                                    </tr>
                                </thead>
                                <div class="panel-body panel-green"></div>
                            <tbody>
                                <?php
/*$i=0; */                              //  $contador = 0;
                                    while ($filaAU3 = mysql_fetch_array($consultaActiviadesVenideras)) {
                                        $id= $filaAU3['id_sub_Actividad'];
                                        $id_Act= $filaAU3['idActividad'];
                                        ?>
                                <tr>
                                <td><button id="finalizar" type="button" class="btn btn-success "><i class="fa fa-check"></i> </button></td>
                                <td><?php echo $filaAU3['id_sub_Actividad'] ?> </td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $filaAU3['nombre'] ?></div></td>
                                <td><?php echo $filaAU3['idActividad'] ?></td>
                                <td><div class="text" id="fecha-<?php echo $id ?>"><?php echo $filaAU3['fecha_monitoreo'] ?></div></td>
                                <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $filaAU3['descripcion'] ?></div></td>                     
                                </tr>
                                        <?php
                                    }
                                    ?>
                            
                            </div>
                            </table>   
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
            $("#subActividades").click(function() {
                var nroEm = "<?php echo $nroEmpleado; ?>" ;
                //alert(nroEm);
                data1 = {nroEm: nroEm};
                $("#contenedorUsuarios").load('pages/actividadesDeUsuario.php', data1);
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
    $('#ActHoy').dataTable({
	    "order": [[ 0, "asc" ]],
	    "fnDrawCallback": function( oSettings ) {		
		}
	}); // example es el id de la tabla
});
 
</script>
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#ActHoy')
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
                   $("#contenedorUsuarios").load('pages/EstadisticasPerfilEmpleado.php');                   
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
                            idSubAct: id
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
                    $("#CuerpoSubActividadRealizada").load('pages/subActividadRealizada.php', data);                   
                    $("#ActividadRealizada").modal('show');                  
                }

                function problemas()
                {
                    $("#contenedor").text('Problemas en el servidor.');
                }
            </script>
</html>