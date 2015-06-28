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

<?php $idusuario= $_SESSION['user_id']; ?> 

<?php 
	
	$rol = $_SESSION['user_rol'];
	require_once("../../conexion/conn.php"); 
	$conexion = mysqli_connect($host, $username, $password, $dbname);
	if($rol == 30){
		$query = mysqli_query($conexion, "SELECT  Id_departamento FROM empleado where No_Empleado in (Select No_Empleado from usuario where id_Usuario='".$idusuario."')");
		mysqli_data_seek ($query,0);
		$extraido = mysqli_fetch_array($query);
		
		
		$consulta  = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento where permisos.id_departamento = '".$extraido['Id_departamento']."' and
			permisos.estado = 'Espera' or permisos.estado = 'Aprobado' ORDER BY fecha asc");

	}else{
		if($rol == 50){
			$consulta = mysqli_query($conexion, "Select permisos.id_Permisos, Primer_nombre, Segundo_nombre, Primer_apellido, Segundo_Apellido, dias_permiso, 
			DATE_FORMAT(fecha,'%d-%m-%Y') as fecha, hora_inicio, hora_finalizacion, motivos.descripcion as mtd, permisos.estado,
			departamento_laboral.nombre_departamento from permisos inner join motivos on permisos.id_motivo=motivos.Motivo_ID 
			inner join empleado on empleado.No_Empleado=permisos.No_Empleado inner join persona on persona.N_identidad=empleado.N_identidad 
			inner join departamento_laboral on departamento_laboral.id_departamento_laboral = permisos.id_departamento 
			where permisos.estado = 'Visto' or permisos.estado = 'Aprobado' ORDER BY fecha asc");
		}
	}
?>

<!DOCTYPE html>

<html lang="en">


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
</head>
<!--<script type="text/javascript" src="../SistemaCienciasJuridicas/js/jquery-2.1.3.js"></script>-->
	
<body>

    <div id="wrapper">
		<h1 class="page-header">Control de Permisos</h1>
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
								<th><strong>Hora Inicio</strong></th>
								<th><strong>Hora Finalizaci&#243;n</strong></th>												
								<th><strong>Motivo</strong></th>
								<th><strong>Departamento</strong></th>
								<th><strong>Aprobar</strong></th>
								<th><strong>Denegar</strong></th>
								<th><strong>Exportar</strong></th>
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
			$estado = $row['estado'];
			$Depto = $row['nombre_departamento'];
			
            
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
			   if($estado=="Espera" or $estado == "Visto"){
				echo<<<HTML
				<td><center>
					<button class="aprobarb btn btn-primary glyphicon glyphicon-thumbs-up"  title="Aprobar">
                </center></td>
HTML;
				}else{ echo <<<HTML
				<td><center>
					<button class="btn btn-primary glyphicon glyphicon-thumbs-up"  title="Aprobar">
                </center></td>
HTML;
				}
				
				if($estado=="Espera" or $estado == "Visto"){
				echo<<<HTML
				<td><center>
					<a class="open-Modal btn btn-primary" data-toggle="modal" data-id=$idP data-target="#compose-modal"><i class="fa fa-edit"></i></a>
                </center></td>
HTML;
				}else{ echo <<<HTML
				<td><center>
					<a class="btn btn-primary" data-toggle="modal" data-target="#"><i class="fa fa-edit"></i></a>
                </center></td>
HTML;
				}
			    if($estado=="Aprobado"){
				echo<<<HTML
				<td><center>
					<button class="btn btn-default pull-right" data-mode="verPDF" data-id=$idP href="#">ExportarPDF</button>
                </center></td>
HTML;
				}else{
				echo<<<HTML
				<td><center>
					<button class="btn btn-default pull-right" disabled = "true">ExportarPDF</button>
                </center></td>
HTML;
				}
                echo "</tr>";

            }

             
            ?>
           </div><!-- /.box-body -->
       </div><!-- /.box -->
</div>

<div id="contenedor2">

</div>


 <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" id="form" name="form" action="#">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Justificación de denegación </h4>
      </div>
              <div class="modal-body">
                  <div class="form-group">
                      <div class="input-group">
                              <div class="input-group">
								  <input id="Permiso" type="hidden" class="form-control" value = ""  required>
                                  <input id="observacion" type="text" class="form-control" placeholder="Justificaci&#243;n de Deniego"    required>
                                  <span class="input-group-btn">
                                      <button id="guardarJ" class="guardarJ btn btn-primary" type="button">Finalizar</button>
                                  </span>
                              </div>
                           
                        
                      </div>   
                       
                  </div>
                  
              </div>
           <!--  <div class="modal-footer clearfix">
            <button name="submit" id="submit" class="insertarbg btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Insertar</button>
          </div>
           -->
                
                    
          </form>
    
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div> 


<script language="javascript" type="text/javascript">
$(document).on("click", ".open-Modal", function () {
	id = $(this).parents("tr").find("td").eq(0).html();
	var myDNI = $(this).data('id');
	$(".modal-body #Permiso").val(myDNI);
});

$(document).ready(function() {
	$(".btn-default").on('click',function(){
          mode = $(this).data('mode');
          id1 = $(this).data('id');
          if(mode == "verPDF"){
           
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

var x;
x = $(document);
x.ready(inicio);

	function inicio()
	{
		var x;
		x = $(".aprobarb");
		x.click(Aprobacion);
		
		var x;
		x = $("#guardarJ");
		x.click(Denegacion);
	};
	
	
	function Aprobacion()
	{
		var pid=$(this).parents("tr").find("td").eq(0).html();
		var diasp=$(this).parents("tr").find("td").eq(2).html();
		
		data ={codigo:pid, cdias:diasp, usr:"<?php echo $idusuario ?>", rol:"<?php echo $rol ?>"}; 
		$.ajax({
			async: true,
			type: "POST",
			dataType: "html",
			contentType: "application/x-www-form-urlencoded",
		    url:"../SistemaCienciasJuridicas/pages/permisos/aprobarSolicitud.php",  
			beforeSend: inicioEnvio,
			success: llegadaAprobar,
			data:data,
			timeout: 4000,
			error: problemas
		});
		return false;
	}
	
	
	function Denegacion()
	{
		
		data ={idpermiso:$('#Permiso').val(), obs:$('#observacion').val()};
		$.ajax({
			async: true,
			type: "GET",
			dataType: "html",
			data:data,
			contentType: "application/x-www-form-urlencoded",
		    url:"../SistemaCienciasJuridicas/pages/permisos/denegarSolicitud.php",  
			beforeSend: inicioEnvio,
			success: llegadaDenegar,
			timeout: 4000,
			error: problemas
		});
		return false;
	}
            
	function inicioEnvio()
	{
		var x = $("#contenedor");
		x.html('Cargando...');
	}
	
	function llegadaAprobar()
	{
		alert("Transacción completada correctamente");
		$("#contenedor").load('pages/permisos/revision.php', data);
	}
	
	function llegadaDenegar()
	{
		$("#contenedor").load('../SistemaCienciasJuridicas/pages/permisos/denegarSolicitud.php', data);
		alert("Transacción completada correctamente");
		$("#contenedor").load('pages/permisos/revision.php');
	}
	
	//Muestra un mensaje de error cuando la transacción falla
	function problemas()
	{
    $("#contenedor").text('Problemas en el servidor.');
	}

</script>

					
</body>
</html>
