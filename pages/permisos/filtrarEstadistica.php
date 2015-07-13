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
  
   if(!isset( $_SESSION['user_id'] ))
  {
    header('Location: '.$maindir.'login/logout.php?code=100');
    exit();
  }
  
require_once("../../conexion/conn.php");  
$conexion = mysqli_connect($host, $username, $password, $dbname);
  
?>

<?php $idusuario= $_SESSION['user_id']; ?> 

<?php 

////VARIABLES DEL POST

//$depto = $_POST['area'];
$motivo =  $_POST['motivo'];
$fechai =  $_POST['fecha_i'];
$fechaf =  $_POST['fecha_f'];
//echo $motivo;
$consulta=0;
if( ($fechai!="" and $fechaf!="")){
$consulta=1;
}
	
	$query = mysqli_query($conexion, "SELECT  Id_departamento, No_Empleado FROM empleado where No_Empleado in (Select No_Empleado from usuario where id_Usuario='".$idusuario."')");
	mysqli_data_seek ($query,0);
	$extraido2 = mysqli_fetch_array($query);
	
	//Filtrado por fechas
if($motivo!='-1'  ){
                           
	
		
	$query1  = mysqli_query($conexion, " Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
		DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado
		from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
		inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
		inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento where 
		motivos.descripcion='".$motivo." ' and 
		permisos.No_Empleado='".$extraido2['No_Empleado']."' and
		date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
		GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento,motivos.descripcion ORDER BY Primer_nombre asc");

	}

if($motivo=='-1'  ){
                           
		
	$query1  = mysqli_query($conexion, " Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
		DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado
		from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
		inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
		inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento where 
		permisos.No_Empleado='".$extraido2['No_Empleado']."' and
		date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
		GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento,motivos.descripcion ORDER BY Primer_nombre asc");

	}	


?>      


	  <div class="box-body table-responsive" visibility: hidden;>
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
								<th><strong>Hora Inicio Nombre</strong></th>
								<th><strong>Hora Finalizaci&#243;n</strong></th>												
								<th><strong>Motivo</strong></th>
								<th><strong>Estado</strong></th>
							</tr>
						</thead>
						<tbody>
HTML;
if ($consulta==1){
            while ($row = mysqli_fetch_array($query1))  {

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
                <td>$estado</td>
HTML;
                echo "</tr>";

            }

}
     else
	 {
		 echo "  <div class='panel panel-red'><h4  color='red'>Por favor seleccione un per&#237;odo de tiempo </h4></div>";
		 
		 
	 }	 
            ?>
			
			
           </div><!-- /.box-body -->
		   
       </div><!-- /.box -->
	   
	   