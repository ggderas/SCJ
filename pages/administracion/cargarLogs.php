<?php

  if(!isset($maindir)){
    $maindir = "../../";
  }
  
  require_once($maindir."conexion/config.inc.php");

    $query3 = $db->prepare("SELECT usuario.nombre, usuario_log.fecha_log, usuario_log.ip_conn 
	                          FROM usuario INNER JOIN usuario_log ON usuario.id_Usuario = usuario_log.usuario");
    $query3 -> execute();
    $result3 = $query3 ->fetchAll();
	
	$query3 = null;
	if(!isset($estaEnPrincipal)){
        $db = null;
	}

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
        <h3 class="box-title">Logs</h3>
      </div><!-- /.box-header -->
     
      <div class="box-body table-responsive">
      <table id="tabla_logs" class='table table-bordered table-striped'>
        <thead>
            <tr>
              <th>Fecha de ingreso</th>
			  <th>Usuario</th>
			  <th>Ip de conn</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($result3 as $row) { 
			
			    echo '<tr>';
                echo '<td>'.$row['fecha_log'].'</td>';
			    echo '<td>'.$row['nombre'].'</td>';
		 	    echo '<td>'.$row['ip_conn'].'</td>';
			    echo '</tr>';
			
			} 
?>
        </tbody>
    </table>
    </div>
 
</section><!-- /.content -->
 
<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_logs').dataTable({}); // example es el id de la tabla
	
	$('#tabla_logs')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
  });
</script>