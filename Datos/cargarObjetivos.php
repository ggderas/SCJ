<?php
$ide= $_POST['id'];
include '../Datos/conexion.php';
// aqui falta aplicar el filtro para que solo carge los Objetivos de Un solo POA
//$query = mysql_query("SELECT * FROM objetivos_institucionales",$enlace);
$query = mysql_query("SELECT * FROM objetivos_institucionales where id_Poa='".$ide."'",$enlace);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
    
    
    </script>
    
    
    

    
</head>

<body>
<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>                                            
                                            <th>Definicion</th>
                                            <th>Area Estrategica</th>
                                            <th>Resultado</th>
                                            <th>Area que Pertenece</th>                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
				while($row = mysql_fetch_array($query))
				{
					$id = $row['id_Objetivo'];
					?>
					<tr>
                        <td><div class="text" id="definicion-<?php echo $id ?>"><?php echo $row['definicion']?></div></td>
                        <td><div class="text" id="area-<?php echo $id ?>"><?php echo $row['area_Estrategica']?></div></td>
                        <td><div class="text" id="resultado-<?php echo $id ?>"><?php echo $row['resultados_Esperados']?></div></td>
                        <td><div class="text" id="campo-<?php echo $id ?>"><?php echo $row['id_Area']?></div></td>
                        <td><button id="ver" type="button" class="verObjetivo btn btn-success">Ver</button></td>
                        
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
    
</body>

</html>