<?php

    $maindir = "../../";

  if(isset($_GET['contenido']))
    {
      $contenido = $_GET['contenido'];
    }
  else
    {
      $contenido = 'permisos';
    }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");

  require_once($maindir."pages/navbar.php");

if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }
  
?>

<html lang ="en">
<body>
 

    
  <?php $idusuario= $_SESSION['user_id']; ?> 

<?php 

	$rol = $_SESSION['user_rol'];
	require_once("../../conexion/conn.php"); 
	$conexion = mysqli_connect($host, $username, $password, $dbname);
	$encontro=1;
		//$query1 = mysqli_query($conexion, "SELECT Id_departamento FROM empleado where ='".$unidad."'");
		$query = mysqli_query($conexion, "SELECT  Id_departamento, No_Empleado FROM empleado where No_Empleado in (Select No_Empleado from usuario where id_Usuario='".$idusuario."')");
		mysqli_data_seek ($query,0);
		$extraido = mysqli_fetch_array($query);
//		echo $extraido['No_Empleado'];
	
		
		
		$consulta  = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, 
			departamento_laboral.nombre_departamento,estado from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento where  
			 permisos.id_departamento = '".$extraido['Id_departamento']."' and permisos.No_Empleado='".$extraido['No_Empleado']."' ORDER BY fecha asc");
	
		require_once($maindir."pages/permisos/menu_permisos.php");
	?>

<div class="container-fluid">
<div class="row">
  <div class="col-sm-9">
                      <div id="contenedor" class="content-panel">
				   

                        <div class="col-lg-12">
                            <h1 class="page-header">Mis Solicitudes!</h1>
                        </div>
                        <div class="panel-heading">
						
                            Estado de sus Solicitudes  
							
						<div class="box-body table-responsive">
		    <?php
            
			    echo <<<HTML
					<table id="tabla_Solicitudes" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th><strong>Permiso</strong></th>
								<th><strong> Nombre</strong></th>
								<!--<th><strong>Segundo Nombre</strong></th>
								<th><strong>Primer Apellido</strong></th>
								<th><strong>Segundo Apellido</strong></th>-->
								<th><strong>D&#237;as</strong></th>
								<th><strong>Fecha Solicitud</strong></th>
								<th><strong>Hora Inicio</strong></th>
								<th><strong>Hora Finalizaci&#243;n</strong></th>												
								<th><strong>Motivo</strong></th>
								<th><strong>Departamento</strong></th>
								<th><strong>Estado</strong></th>
								
							</tr>
						</thead>
						<tbody>
HTML;

            while ($row = mysqli_fetch_array($consulta))  {

            $idP = $row['id_Permisos'];
            $pnombre = $row['Primer_nombre'];
			$snombre = $row['Segundo_nombre'];
			$papellido = $row['Primer_apellido'];
			$sapellido = $row['Segundo_Apellido'];
			$dias = $row['dias_permiso'];
			$fecha = $row['fecha'];
            $horaI = $row['hora_inicio'];
			$horaF = $row['hora_finalizacion'];			
			$motivo = $row['mtd'];
			$Depto = $row['nombre_departamento'];
			$estado = $row['estado'];
			
            
                echo "<tr data-id='".$idP."'>";
                echo <<<HTML
                <td>$idP</td>

HTML;
             
                echo <<<HTML
                <td>
				
				
				$pnombre
			    $snombre 
				$papellido 
				$sapellido 
				
				
</td>
HTML;
                echo <<<HTML
                <td>$dias</td>
HTML;
                echo <<<HTML
                <td>$fecha</td>
HTML;
                echo <<<HTML
                <td>$horaI</td>
HTML;
                echo <<<HTML
                <td>$horaF</td>
HTML;
                echo <<<HTML
                <td>$motivo</td>
HTML;
                echo <<<HTML
                <td>$Depto</td>
HTML;
                echo <<<HTML
                <td><center>
					$estado              
				</center></td>
				
HTML;
				

				echo "</tr>";
	
            }

             
            ?>
           </div>
                        </div>
						<div class="panel-body">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
 </div>

<!--	-->
	
</body>
</html>
	
	
<script>

</script>
	
	