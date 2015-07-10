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

$depto = $_POST['area'];
$motivo =  $_POST['motivo'];
$fechai =  $_POST['fecha_i'];
$fechaf =  $_POST['fecha_f'];

$consulta=0;
if( ($fechai!="" and $fechaf!="")){
$consulta=1;
}
	
	
// sin filtros	
 if( $depto=='-1' and  $motivo=='-1'){
        
                     
		
	$query1  = mysqli_query($conexion, " 
Select Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento, motivos.descripcion, 
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
	GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento ORDER BY Primer_nombre asc");


	}
	
// 	con filtro del departemento
	if( $depto!='-1' and  $motivo=='-1'   and ($fechai!="" and $fechaf!="")){
    		
	$query1  = mysqli_query($conexion, " 
Select Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento,motivos.descripcion,  
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where  departamento_laboral.nombre_departamento='".$depto."'
 and date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
	GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento ORDER BY Primer_nombre asc");
}
		
	// 	con filtro del motivos y depattamento 	
		if( $depto!='-1' and  $motivo!='-1'   and ($fechai!="" and $fechaf!="")){
                           
	
			
	$query1  = mysqli_query($conexion, " 
Select Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento,motivos.descripcion, 
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where  departamento_laboral.nombre_departamento='".$depto."' and motivos.descripcion='".$motivo."' and 
 date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')	
	GROUP BY Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento,motivos.descripcion ORDER BY Primer_nombre asc");

	}
	
// 	por fechas 
		if( $depto=='-1' and  $motivo!='-1'  ){
                           
	
		
	$query1  = mysqli_query($conexion, " 
Select Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, departamento_laboral.nombre_departamento, motivos.descripcion, 
COUNT(permisos.id_Permisos) as Solicitudes, SUM(permisos.dias_permiso) as Inasistencias from permisos
 inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
 inner join empleado on empleado.No_Empleado=permisos.No_Empleado 
 inner join persona on persona.N_identidad=empleado.N_identidad 
 inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
 where  motivos.descripcion='".$motivo."' and 
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
								
								<th><strong> Nombre</strong></th>
								<!--<th><strong>Segundo Nombre</strong></th>
								<th><strong>Primer Apellido</strong></th>
								<th><strong>Segundo Apellido</strong></th>-->
								<th><strong>Departamento</strong></th>
								<th><strong>Motivo</th>
								<th><strong>Cantidad Solicitudes</strong></th>
								<th><strong>D&#237;as Faltados</strong></th>
								
							</tr>
						</thead>
						<tbody>
HTML;
if ($consulta==1){
            while ($row = mysqli_fetch_array($query1))  {

           
            $pnombre = $row['Primer_nombre'];
			$snombre = $row['Segundo_nombre'];
			$papellido = $row['Primer_apellido'];
			$sapellido = $row['Segundo_Apellido'];			
			$Depto = $row['nombre_departamento'];
			$Motivo = $row['descripcion'];
			$cant = $row['Solicitudes'];
			
			$faltas = $row['Inasistencias'];
			
            
                echo <<<HTML
                <td>
				
				
				$pnombre
			    $snombre 
				$papellido 
				$sapellido 
				
				
</td>
HTML;
 
     
                echo <<<HTML
                <td>$Depto</td>
HTML;

				echo <<<HTML
                <td>$Motivo</td>
HTML;
                echo <<<HTML
                <td>$cant</td>                
HTML;
				echo <<<HTML
                <td>$cant</td>                
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
	   
	   