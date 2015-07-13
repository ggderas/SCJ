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
    if($tipoProcedimiento == 'insertar'){
      require_once("mantenimiento_ubicacion_notificaciones/InsertarUbicacionNotificaciones.php");
    }elseif($tipoProcedimiento == 'actualizar_'){
      require_once("mantenimiento_ubicacion_notificaciones/ActualizarUbicacionNotificacionesCodigo.php");
    }elseif($tipoProcedimiento == 'eliminar'){
      require_once("mantenimiento_ubicacion_notificaciones/EliminarUbicacionNotificaciones.php");
    }
  }

  $query = $db->prepare("SELECT * FROM ubicacion_notificaciones");
  $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            $ubicacion_notificaciones = 1;
        }else{
            $ubicacion_notificaciones = 0;
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
        <h3 class="box-title">Mantenimiento de la tabla ubicación notificaciones <a class="btn btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i>Insertar</a></h3>
      </div><!-- /.box-header -->

      <div class="box-body table-responsive">
      <table id="tabla_ubicacion_notificaciones" class='table table-bordered table-striped'>
        <thead>
            <tr>
              <th>Id_UbicaciónNotificaciones</th>
              <th>DescripcionUbicaciónNotificaciones</th>
              <th>Actualización</th>
              <th>Eliminación</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($rows as $row) {   
            $Id_UbicacionNotificaciones = $row['Id_UbicacionNotificaciones'];
        ?>
        
            <tr>
               <td><?php echo $row['Id_UbicacionNotificaciones']; ?></td>
                <td><?php echo $row['DescripcionUbicacionNotificaciones']; ?></td>
<?php

echo '<td><a class="btn btn-block btn-primary" data-mode="actualizar" data-id="'.$Id_UbicacionNotificaciones.'" href="#">Actualizar</a></td>';
echo '<td><a class="btn btn-block btn-primary" data-mode="eliminar" data-id="'.$Id_UbicacionNotificaciones.'" href="#"></i>Eliminar</a></td>';

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

<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	  <form role="form" id="form" name="form" action="#">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Insertar una nueva ubicación de la notificacion</h4>
      </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Descripción de la ubicación dela notificación</span>
                <input name="DescripcionUbicacionNotificaciones" id="Insertar_DescripcionUbicacionNotificaciones" type="text" class="form-control" placeholder="DescripcionUbicacionNotificaciones" maxlength="50" required>
              </div>
            </div>            
          </div> 
          <div class="modal-footer clearfix">
            <button name="submit" id="submit" class="btn btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Insertar</button>
          </div>
		</form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_ubicacion_notificaciones').dataTable({
	  "order": [[ 0, "asc" ]],
	  "fnDrawCallback": function( oSettings ) {
	  
	  $(".btn-primary").unbind('click');
	  
	  $(".btn-primary").on('click',function(){
        mode = $(this).data('mode');
        id = $(this).data('id');
        if(mode == "actualizar"){
          data={
            Id_UbicacionNotificaciones:id,
            tipoProcedimiento:"actualizar"
          };
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones/ActualizarUbicacionNotificaciones.php", 
                success:actualizarUbicacionNotificaciones,
                timeout:4000,
                error:problemas
          }); 
          return false;
        }else if(mode == "eliminar"){
          data={
            Id_UbicacionNotificaciones:id,
            tipoProcedimiento:"eliminar"
          };
          if (confirm('Esta seguro que desea eliminar este registro?')) {
          $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php", 
                success:eliminarUbicacionNotificaciones,
                timeout:4000,
                error:problemas
          }); 
          }
          return false;
        }
       });
	  }
	}); // tabla_ubicacion_notificaciones es el id de la tabla
  });
  
    function eliminarUbicacionNotificaciones(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones.php',data);
    }
    function actualizarUbicacionNotificaciones(){

            $("#div_contenido").load('pages/mantenimientos_gestion_folios/mantenimiento_ubicacion_notificaciones/ActualizarUbicacionNotificaciones.php',data);
    }
</script>

<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_ubicacion_notificaciones')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>

<script type="text/javascript" src="js/gestion_folios/mantenimiento_ubicacion_notificaciones.js" ></script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
