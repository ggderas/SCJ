<?php

  if(!isset($maindir)){
    $maindir = "../";
  }
  
  require_once($maindir."conexion/config.inc.php");

  if(isset($_POST['tipoProcedimiento'])){
    $tipoProcedimiento =  $_POST['tipoProcedimiento'];
	if($tipoProcedimiento == 'insertar'){
	  require_once("insertarUsuario.php");
	}elseif($tipoProcedimiento == 'actualizar_'){
	  require_once("actualizarUsuario.php");
	}
  }

    $query3 = $db->prepare("SELECT usuario.id_Usuario, usuario.No_Empleado, usuario.nombre, usuario.Id_Rol, usuario.Fecha_Creacion,
     	usuario.Fecha_Alta, usuario.Estado, roles.Descripcion FROM usuario INNER JOIN roles ON usuario.Id_Rol = roles.Id_Rol");
    $query3 -> execute();
    $result3 = $query3 ->fetchAll();
	
	$query3 = null;
	$db = null;

?>

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

<!-- muestra el folio y datos mas importantes de los folios que se levantaron Usuarios  -->
      <div class="box-header">
        <h3 class="box-title">Usuarios</h3>
      </div><!-- /.box-header -->
     
      <div class="box-body table-responsive">
      <table id="tabla_usuarios" class='table table-bordered table-striped'>
        <thead>
            <tr>
              <th>Nro. Empleado</th>
              <th>Nombre</th>
              <th>Rol</th>
              <th>Fecha_Creacion</th>
			  <th>Fecha_Alta</th>
			  <th>Estado</th>
              <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($result3 as $row) { 
            $idUsuario = $row['id_Usuario'];
			$estado = $row['Estado'];
			
            echo '<td>'.$row['No_Empleado'].'</td>';
			echo '<td>'.$row['nombre'].'</td>';
			echo '<td>'.$row['Descripcion'].'</td>';
			echo '<td>'.$row['Fecha_Creacion'].'</td>';
			echo '<td>'.$row['Fecha_Alta'].'</td>';
			if($estado == 1){
				echo '<td>Activo</td>';
			}else{
				echo '<td>Inactivo</td>';
			}

echo '<td><button class="nUser btn btn-primary glyphicon glyphicon-edit" data-id="'.$idUsuario.'" href="#"></button></td>';

echo '</tr>';
 } 
?>
        </tbody>
    </table>
    </div>
 
 </section><!-- /.content -->

<!-- modal para modificar datos del usuario -->
<div class="modal fade" id="compose-modal-actualizar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
		    <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-floppy-disk"></i> Modificacion de Datos del Usuario </h4>
            </div>
			<div class="modal-body"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
 
	<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
  
    $('#tabla_usuarios').dataTable({
	  "order": [[ 1, "desc" ]],
	  "fnDrawCallback": function( oSettings ) {
		$(".nUser").unbind('click');
		
		$(".nUser").on('click',function(){
          id = $(this).data('id');
		   $.get('Datos/modi_usuario.php?idUsuario=' + id, function(html){
                 $('#compose-modal-actualizar .modal-body').html(html);
                 $('#compose-modal-actualizar').modal('show', {backdrop: 'static'});
		    });
        });
      }
	}); // example es el id de la tabla
  });
  
</script>

<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_alerta')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>