<?php
include '../Datos/conexion.php';

$query = mysql_query("SELECT * FROM poa  ORDER BY fecha_Fin DESC",$cn);
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
                                            <th>id</th>
                                            <th>Titulo</th>
                                            <th>DEL</th>
                                            <th>Al</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
				while($row = mysql_fetch_array($query))
				{
					$id = $row['id_Poa'];
					?>
					<tr>
                                            <td><?php echo $row['id_Poa']?></td>
                        <td><div class="text" id="titulo-<?php echo $id ?>"><?php echo $row['nombre']?></div></td>
                        <td><div class="text" id="del-<?php echo $id ?>"><?php echo $row['fecha_de_Inicio']?></div></td>
                        <td><div class="text" id="al-<?php echo $id ?>"><?php echo $row['fecha_Fin']?></div></td>
                        <td><a class="elimina btn btn-primary ">Ir</a></td>
                        <td><a class="elimina btn btn-primary ">Ir</a></td>
                        
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