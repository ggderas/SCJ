<?php
include '../Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge los indicadores de un solo objetivo
$query = mysql_query("SELECT * FROM indicadores",$enlace);
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
                                            <th>Nombre</th>
                                            <th>Descripcion </th>                                                                                    
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
				while($row = mysql_fetch_array($query))
				{
					$id = $row['id_Indicadores'];
					?>
					<tr>
                        <td><div class="text" id="nombre-<?php echo $id ?>"><?php echo $row['nombre']?></div></td>
                        <td><div class="text" id="descripcion-<?php echo $id ?>"><?php echo $row['decripcion']?></div></td>                        
                        <td><button id="ver" type="button" class="btn btn-success">Ver</button></td>
                        
                    </tr>
					<?php
				}
				 ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
    
 
</body>

</html>