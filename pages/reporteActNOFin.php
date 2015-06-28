




<?php

include '../Datos/conexion.php';
//$query = mysql_query("call sp_lee_actividades_terminadas_poa()", $enlace);

?>



<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>
            <a href="pages/pdfActividadesNORealizadas.php" target="_blank">Exportar Reporte</a>
            
        </div>
        
        <div class="panel-default">
            <div>
                <h1>Actividades NO Realizadas </h1>
            </div>
            <div class="box-body table-responsive">
            <table id="tabla_prioridad" class='table table-bordered table-striped'>
                <thead>
                    <tr>   
                        
                        <th>Nombre Actividad</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                       
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../Datos/conexion.php';
                    $query = mysql_query("call sp_lee_actividades_no_terminadas_poa()", $enlace);
                    while ($row = mysql_fetch_array($query)) {
                   
                        ?>
                        <tr>
                            
                            <td><div class="text" ><?php echo $row['descripcion'] ?></div></td>
                            <td><div class="text" ><?php echo $row['fecha_inicio'] ?></div></td>
                            <td><div class="text" ><?php echo $row['fecha_fin'] ?></div></td>
                             
                            
                           
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
            
            
            
                    
                </div>
        
        
        
        
    </body>
</html>
