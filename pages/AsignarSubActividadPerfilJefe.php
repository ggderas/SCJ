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



include '../Datos/conexion.php';

if (isset($_SESSION['user_id'])) {
    $id_Usuario = $_SESSION['user_id'];
}
$consulta = mysql_query("select usuario.No_Empleado from usuario where usuario.id_Usuario=" . $id_Usuario . "", $enlace);

while ($nro_Emp = mysql_fetch_array($consulta)) {
    $nroEmpleado = $nro_Emp['No_Empleado'];
}


$consultaActividadesHoy = mysql_query('select distinct actividades.id_actividad, actividades.descripcion, actividades.correlativo, actividades.fecha_inicio,actividades.fecha_fin
from actividades
inner join actividades_terminadas  on actividades.id_actividad <> actividades_terminadas.id_Actividad
inner join responsables_por_actividad on responsables_por_actividad.id_Actividad = actividades.id_actividad
inner join grupo_o_comite on grupo_o_comite.ID_Grupo_o_comite = responsables_por_actividad.id_Responsable
inner join grupo_o_comite_has_empleado on grupo_o_comite_has_empleado.No_Empleado="'.$nroEmpleado.'"
where actividades.id_actividad <> actividades_terminadas.id_Actividad and year(fecha_fin)= year(now()) and fecha_fin>now()',$enlace);
        
?>

<!doctype html>
<html lang="es">
    <head></head>
    
        
                      <div id="wrapper">  
      
                       <div class="col-lg-12" class="center center-block">
                          <div class="box-body table-responsive panel panel-green">
                                    <div class="panel-heading">
                               Actividades 
                                    </div>
                    
                            <table id="ActFutura"  class='table table-bordered table-striped'>
                                <thead class="panel panel-green">
                                    <tr>
                                    <th>Asignar</th>
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
                                    while ($filaAU = mysql_fetch_array($consultaActividadesHoy)) {
                                       
                                        ?>
                                <tr>
                                <td><button id="Asignar" type="button" class="btn btn-success "><i class="fa fa-adn"></i> </button></td>
                                <td><?php echo $filaAU['id_actividad'] ?></td>
                                <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $filaAU['descripcion'] ?></div></td>
                                <td><div class="text" id="id_Act-<?php echo $id ?>"><?php echo $filaAU['correlativo'] ?></div></td>
                                <td><?php echo $filaAU['fecha_inicio'] ?></td>
                                <td><?php echo $filaAU['fecha_fin'] ?></td>                     
                                </tr>
                                        <?php
                                    }
                                    ?>
                            
                            </div>
                            </table>   
                         </div> 
                       </div>
</div>
                 
      <div class="modal fade" id="ActividadRealizada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Sub Actividad</h4>
                </div>
                <div class="modal-body" id="CuerpoSubActividadRealizada">
                    
                </div>

            </div>
        </div>
    </div>
    </body>
               
    
    
 

 

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

                    $("#Asignar").click(function() {
                        id = $(this).parents("tr").find("td").eq(1).html();
                        inAc=$(this).parents("tr").find("td").eq(4).html();
                        fiAc=$(this).parents("tr").find("td").eq(5).html();
                       // alert(id);   
                       // alert(inAc); 
                        //alert(fiAc); 
                        data = {
                            idAct: id,
                            iniAct:inAc,
                            finAct:fiAc
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
                    $("#CuerpoSubActividadRealizada").load('pages/crearSubActividad.php', data);                   
                    $("#ActividadRealizada").modal('show');                  
                }

                function problemas()
                {
                    $("#contenedor").text('Problemas en el servidor.');
                }
            </script>
</html>