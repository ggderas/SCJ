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
  
?>

<?php 

$idusuario= $_SESSION['user_id']; 
$idempleado= $_POST['idempleado'];
$depto = $_POST['area'];
$motivo =  $_POST['motivo'];
$fechai =  $_POST['fecha_i'];
$fechaf =  $_POST['fecha_f'];
$rol = $_SESSION['user_rol'];
//echo $fechai;
//echo $fechaf;

$consulta2=0;
//echo $idempleado;

if( $fechai!="" and $fechaf!=""){
	$consulta2=1;

}

?> 


<?php 
	
	$rol = $_SESSION['user_rol'];
	require_once("../../conexion/conn.php"); 
	$conexion = mysqli_connect($host, $username, $password, $dbname);
	
	
		$query = mysqli_query($conexion, "SELECT  Id_departamento FROM empleado where No_Empleado in (Select No_Empleado from usuario where id_Usuario='".$idusuario."')");
		mysqli_data_seek ($query,0);
		$extraido = mysqli_fetch_array($query);
		

	if($rol == 30){
		if( $motivo!='-1' ){
		
			$consulta4 = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where permisos.id_departamento = '".$extraido['Id_departamento']."'
			and motivos.descripcion='".$motivo."' 
			and date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc");
			}
			
			if( $motivo=='-1' ){
		
			$consulta4 = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where 	permisos.id_departamento = '".$extraido['Id_departamento']."'
			and  date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc");
			}
		
		
	

	}else{
		if($rol == 50){
			if( $motivo!='-1' and $depto!='-1'){
		
			$consulta4 = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where  departamento_laboral.nombre_departamento ='".$depto."' and  motivos.descripcion='".$motivo."' and
			date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			and motivos.descripcion='".$motivo."'
			ORDER BY fecha asc");}
				if( $motivo=='-1' and $depto!='-1'){
		
			$consulta4 = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where  departamento_laboral.nombre_departamento ='".$depto."' 
		    and date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc");}
			
			if( $motivo!='-1' and $depto=='-1'){
		
			$consulta4 = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where  motivos.descripcion='".$motivo."' 
			and	date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc");}
				
			if( $motivo=='-1' and $depto=='-1'){
		
			$consulta4 = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where 	date_format(permisos.fecha,'%d-%m-%Y') between  date_format('".$fechai." ','%d-%m-%Y')and date_format('".$fechaf."','%d-%m-%Y')
			and empleado.No_Empleado='".$idempleado." '
			ORDER BY fecha asc");}
			
		
		}
	}
?>


<!DOCTYPE html>

<html lang="en">


<head>
	<!--<meta charset="utf-8">-->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
</head>
<!--<script type="text/javascript" src="../SistemaCienciasJuridicas/js/jquery-2.1.3.js"></script>-->
	
<body>

    <div id="wrapper">
		<h1 class="page-header">Solicitudes de Permisos</h1>
			<div class="box">
            <div class="box-header">
           
            </div><!-- /.box-header -->
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
								<th><strong>Hora Inicio Nombre</strong></th>
								<th><strong>Hora Finalizaci&#243;n</strong></th>												
								<th><strong>Motivo</strong></th>
								<th><strong>Departamento</strong></th>
								<th><strong>Exportar</strong></th>
							</tr>
						</thead>
						<tbody>
HTML;

if ($consulta2==1){
            while ($row = mysqli_fetch_array($consulta4))  {

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
                //echo <<<HTML <td><a href='javascript:ajax_("'$url'");'>$NroFolio</a></td>HTML;
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
                if($estado=="Aprobado" or $estado == 'Finalizado'){
				echo<<<HTML
				<td><center>
					<button class="btn btn-default pull-right" data-mode="verPDFE" data-id=$idP href="#">ExportarPDF</button>
                </center></td>
HTML;
				}else{echo <<<HTML
					<td><center>
						<button class="btn btn-default pull-right" disabled="true" >Inhabilitado</button>
					</center></td>					
HTML;
				}
				
                echo "</tr>";

            } }
     else
	 {
		 echo "  <div class='panel panel-red'><h4  color='red'>Por favor establesca un per&#237;odo de tiempo. </h4></div>";
		 
		 
	 }	

             
            ?>
           </div><!-- /.box-body -->
       </div><!-- /.box -->
</div>




<script language="javascript" type="text/javascript">
$( document ).ready(function() {
	$(".btn-default").on('click',function(){
          mode = $(this).data('mode');
          id1 = $(this).data('id');
          if(mode == "verPDFE"){
           
			data={
            id1:id1
            };
            $.ajax({
                async:true,
                type: "GET",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/permisos/crear_pdfpermiso.php", 
                success:reportePDF,
                timeout:4000,
                error:problemas
            }); 
            return false;
          }
        });
});

function reportePDF(data){
	window.open('pages/permisos/crear_pdfpermiso.php?id1='+id1);
}

</script>

					
</body>
</html>
