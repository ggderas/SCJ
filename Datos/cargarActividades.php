<?php
include 'Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge las actividades  de un solo indicador
$query = mysql_query("SELECT * FROM actividades",$enlace);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
</head>

<body>
<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>                                            
                                            <th>Correlativo</th>
                                            <th>Descripcion </th>
                                            <th>Supuesto</th>
                                            <th>Justificacion</th>
                                            <th>Medio De Verificación</th>
                                            <th>Poblacion Objetivo</th>
                                            <th>Inicio</th>
                                            <th>Fin</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
				while($row = mysql_fetch_array($query))
				{
					$id = $row['id_Actividades'];
					?>
					<tr>
                        <td><div class="text" id="correlativo-<?php echo $id ?>"><?php echo $row['correlativo']?></div></td>
                        <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $row['descripccion']?></div></td>                        
                        
                        <td><div class="text" id="supuestos-<?php echo $id ?>"><?php echo $row['supuestos']?></div></td>
                        <td><div class="text" id="justificacion-<?php echo $id ?>"><?php echo $row['justificacion']?></div></td>
                        <td><div class="text" id="medio_Verificacion-<?php echo $id ?>"><?php echo $row['medio_Verificacion']?></div></td>
                        <td><div class="text" id="poblacion_Objetivo-<?php echo $id ?>"><?php echo $row['poblacion_Objetivo']?></div></td>
                        <td><div class="text" id="fecha_Inicio-<?php echo $id ?>"><?php echo $row['fecha_Inicio']?></div></td>
                        <td><div class="text" id="fecha_Fin-<?php echo $id ?>"><?php echo $row['fecha_Fin']?></div></td>
                        <td><button id="ver" type="button" class="btn btn-success">Responsable</button></td>
                        
                    </tr>
					<?php
				}
				 ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
    <div id="contenedor">
        
    </div>
     <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>   
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>
    
    <script src="js/morris-data.js"></script>    
    <script src="dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="Recursos/jquery-1.11.1.min.js" ></script>
    <script type="text/javascript" src="JAVASCRIPT/menu.js" ></script>
    <script type="text/javascript" src="JAVASCRIPT/ver.js" ></script>
</body>

</html>