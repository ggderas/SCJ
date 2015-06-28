<?php

  $maindir = "../../";

  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
  else
  {
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'mantenimiento';
  }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  require_once($maindir.'pages/navbar.php');

  require_once($maindir."conexion/config.inc.php");

  if(isset($_POST['tipoProcedimiento'])){
    $tipoProcedimiento =  $_POST['tipoProcedimiento'];
    if($tipoProcedimiento == 'actualizar_'){
      require_once("mantenimiento_folio/ActualizarFolioCodigo.php");
    }
  }

  $query = $db->prepare("SELECT folios.NroFolio, folios.PersonaReferente, folios.UnidadAcademica, unidad_academica.NombreUnidadAcademica, folios.Organizacion, 
	    organizacion.NombreOrganizacion, categorias_folios.NombreCategoria, folios.TipoFolio,folios.FechaEntrada, folios.FechaCreacion, folios.UbicacionFisica, 
		ubicacion_archivofisico.DescripcionUbicacionFisica ,folios.Prioridad  ,prioridad.DescripcionPrioridad, folios.DescripcionAsunto 
    	FROM folios INNER JOIN ubicacion_archivofisico ON folios.UbicacionFisica = ubicacion_archivofisico.Id_UbicacionArchivoFisico 
    	INNER JOIN prioridad ON folios.Prioridad = prioridad.Id_Prioridad 
		INNER JOIN categorias_folios ON folios.categoria = categorias_folios.Id_categoria
    	LEFT JOIN unidad_academica ON folios.UnidadAcademica = unidad_academica.Id_UnidadAcademica 
    	LEFT JOIN organizacion ON folios.Organizacion = organizacion.Id_Organizacion
		ORDER BY FechaEntrada");
  $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            $folios = 1;
        }else{
            $folios = 0;
        }
    $query = null;
    $db = null;

?>

<div class="container-fluid">
<div class="row">
<?php 
    require_once("../gestion_folios/navbar.php");
?>
<div class="col-sm-10">
    <section class="content">
 
<?php
 
  if(isset($codMensaje) and isset($mensaje)){
    if($codMensaje == 1){
      echo '<div class="alert alert-success">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Exito! </strong>';
      echo $mensaje;
      echo '</div>';
    }else{
      echo '<div class="alert alert-danger">';
      echo '<a href="#" class="close" data-dismiss="alert">&times;</a>';
      echo '<strong>Error! </strong>';
      echo $mensaje;
      echo '</div>';
    }
  } 

?>

      <div class="box-header">
        <h3 class="box-title">Mantenimiento de la tabla Folio</h3>
      </div><!-- /.box-header -->

      <div class="box-body table-responsive">
      <table id="tabla_folios" class='table table-bordered table-striped'>
        <thead>
            <tr>
              <th>NroFolio</th>
              <th>FechaCreación</th>
              <th>FechaEntrada</th>              
              <th>PersonaReferente</th>
			  <th>UnidadAcadémica</th>
			  <th>Organización</th>
			  <th>Categoría</th>
			  <th>DescripciónAsunto</th>
			  <th>TipoFolio</th>
			  <th>UbicaciónFísica</th>
			  <th>Prioridad</th>
			  <th>Actualización</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($rows as $row) {   
            $foliosNroFolio = $row['NroFolio'];
			if($row['TipoFolio'] == 0){
			    $tipoFolio = "Folio de entrada";
			}else{
			    $tipoFolio = "Folio de salida";
			}
        ?>
        
            <tr>
               <td><?php echo $row['NroFolio']; ?></td>
                <td><?php echo $row['FechaCreacion']; ?></td>
                <td><?php echo $row['FechaEntrada']; ?></td>
				<td><?php echo $row['PersonaReferente']; ?></td>
				<td><?php echo $row['NombreUnidadAcademica']; ?></td>
				<td><?php echo $row['NombreOrganizacion']; ?></td>
				<td><?php echo $row['NombreCategoria']; ?></td>
				<td><?php echo $row['DescripcionAsunto']; ?></td>
				<td><?php echo $tipoFolio; ?></td>
				<td><?php echo $row['DescripcionUbicacionFisica']; ?></td>
				<td><?php echo $row['DescripcionPrioridad']; ?></td>
<?php
echo '<td><a class="btn btn-block btn-primary" data-mode="actualizar" data-id="'.$foliosNroFolio.'" href="#">Actualizar</a></td>';
?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
 
    </section><!-- /.content -->
    </div><!-- /col-10 -->                
  </div><!-- end row -->
</div><!-- end container fluid -->

<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript">

$(document).ready(function() {
    $('#tabla_folios').dataTable({
	
	"order": [[ 0, "asc" ]],
	"fnDrawCallback": function( oSettings ) {
	
	    $(".btn-primary").unbind('click');
	
	    $(".btn-primary").on('click',function(){
        mode = $(this).data('mode');
        id = $(this).data('id');
        if(mode == "actualizar"){
          data={
            NroFolio:id,
            tipoProcedimiento:"actualizar"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_folio/ActualizarFolio.php", 
                success:actualizarFolios,
                timeout:4000,
                error:problemas
          }); 
          return false;
        }
        });
	}
	}); // example es el id de la tabla
});

    function actualizarFolios(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_folio/ActualizarFolio.php',data);
    }
</script>

<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_folios')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>