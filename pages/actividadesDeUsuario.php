<?php
include '../Datos/conexion.php';
$nroEm = $_POST['nroEm'];
$consultaNorealizadas= mysql_query('SELECT * FROM sub_actividad WHERE ( (year(fecha_monitoreo)=year(now())) and (id_Encargado="'.$nroEm.'") and id_sub_Actividad not in (select id_SubActividad from sub_actividades_realizadas where id_SubActividad=sub_actividad.id_sub_Actividad)) order by fecha_monitoreo asc',$enlace);
$consultaActiviadesRealizadas= mysql_query('SELECT * FROM sub_actividad WHERE (year(fecha_monitoreo)=year(now())) and id_Encargado="' . $nroEm. '" and id_sub_Actividad in (select id_SubActividad from sub_actividades_realizadas where sub_actividades_realizadas.id_SubActividad=sub_actividad.id_sub_Actividad) order by `fecha_monitoreo`asc', $enlace);

?>


<!doctype html>
<html lang="es">
    <head>

    </head>
    <body>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    <?php echo $nroEm. " estas son sus Sub-Actividades"; ?>
                    </div>
                    <!-- .panel-heading -->
                    <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">

                            </div>
                            <div id="realizadas" class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <label ><?php echo "Realizadas"; ?></label>
                                    </h4>
                                </div>
                        
                                <div >
                                    <div id="contenedor2" class="panel-body">
                                        <?php
                                        echo "<a href='pages/reporteSubActividadesRealizadaspdf.php?a=$nroEm' target=_blank>Exportar Reporte</a>"
                                                ?>
                                           <table id="tabla_Realizadas" class='table table-bordered table-striped'>
                                                <thead>
                                                        <tr>   
                        
                                                            <th>id Sub-Actividad</th>
                                                            <th>Nombre</th>
                                                            <th>Fecha Monitoreo</th>
                                                            <th>Ponderacion</th>
                                                            <th>Costo</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = mysql_fetch_array($consultaActiviadesRealizadas)) {
                   
                                                    ?>
                                                    <tr>
                            
                                                    <td><div class="text" ><?php echo $row['id_sub_Actividad'] ?></div></td>
                                                    <td><div class="text" ><?php echo $row['nombre'] ?></div></td>
                                                    <td><div class="text" ><?php echo $row['fecha_monitoreo'] ?></div></td>
                                                    <td><div class="text"><?php echo $row['ponderacion'] ?></div></td>
                                                    <td><div class="text"><?php echo $row['costo'] ?></div></td>
                           
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div> 
                            
                             <div id ="norealizadas" class="panel panel-warning">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <label ><?php echo "No Realizadas"; ?></label>
                                    </h4>
                                    
                                </div>
                                <div >
                                    <div id="contenedor2" class="panel-body">
                                       <?php
                                        echo "<a href='pages/reporteSubActividadesnoRealizadaspdf.php?a=$nroEm' target=_blank>Exportar Reporte</a>"
                                                ?>
                                        <table id="tabla_NoRealizadas" class='table table-bordered table-striped'>
                                                <thead>
                                                        <tr>   
                        
                                                            <th>id Sub-Actividad</th>
                                                            <th>Nombre</th>
                                                            <th>Fecha Monitoreo</th>
                                                            <th>Ponderacion</th>
                                                            <th>Costo</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = mysql_fetch_array($consultaNorealizadas)) {
                   
                                                    ?>
                                                    <tr>
                            
                                                    <td><div class="text" ><?php echo $row['id_sub_Actividad'] ?></div></td>
                                                    <td><div class="text" ><?php echo $row['nombre'] ?></div></td>
                                                    <td><div class="text" ><?php echo $row['fecha_monitoreo'] ?></div></td>
                                                    <td><div class="text"><?php echo $row['ponderacion'] ?></div></td>
                                                    <td><div class="text"><?php echo $row['costo'] ?></div></td>
                           
                                                    </tr>
                                                    <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div> 

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body></html> 

 <script type="text/javascript">
        $(document).ready(function() {
            $("#expRealizadas").click(function() {
                var x = "<?php echo $nroEm; ?>" ;
                //alert(nroEm);
                data = {x: nroEm};
                $("#realizadas").load('pages/reporteSubActividadesRealizadaspdf.php', data);
            });
            
        });      
    </script>