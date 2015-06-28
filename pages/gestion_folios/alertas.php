<?php

  $maindir = "../../";

  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
  else
  {
    $contenido = 'gestion_de_folios';
	$navbar_loc = 'contenido';
  }

  require_once($maindir."funciones/check_session.php");

  require_once($maindir."funciones/timeout.php");
  
  require_once($maindir.'pages/navbar.php');

  require_once($maindir."conexion/config.inc.php");
  
  $user = $_SESSION['nombreUsuario'];

  //este arreglo modifica la descripcion de la prioridad es decir cambia de color segun prioridad
  $estadoFolio = array("Normal"=>"btn-success","informativo"=>"btn-success","Urgente"=>"btn-warning");

//hace todos los filtros para mostrar las alertas
  $query = $db->prepare("select alerta.NroFolioGenera, folios.FechaCreacion, folios.DescripcionAsunto, folios.Prioridad, prioridad.DescripcionPrioridad 
from alerta 
inner join folios on alerta.NroFolioGenera=folios.NroFolio AND alerta.Atendido =0
inner join prioridad on folios.Prioridad=prioridad.Id_Prioridad
inner join usuario_alertado on usuario_alertado.Id_Alerta=alerta.Id_Alerta
inner join usuario on usuario.id_Usuario=usuario_alertado.Id_Usuario  and usuario.nombre='$user'
");
  $query->execute();
    $rows = $query->fetchAll();
        if($rows){
            $alerta = 1;
        }else{
            $alerta = 0;
        }
    $query = null;
    $db = null;

?>

<!-- carga todos los link principales del modulo Gestion de folios -->
<div class="container-fluid">
<div class="row">
    <?php 
        require_once("navbar.php");
    ?>
    <div class="col-sm-10">
    <section class="content">


<!-- muestra el folio y datos mas importantes de los folios que se levantaron alertas  -->
      <div class="box-header">
        <h3 class="box-title">Alertas</h3>
      </div><!-- /.box-header -->
     
      <div class="box-body table-responsive">
      <table id="tabla_alerta" class='table table-bordered table-striped'>
        <thead>
            <tr>
              <th>No. de Folio</th>
              <th>Fecha de Creacion</th>
              <th>Asunto</th>
              <th>Prioridad</th>
              <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($rows as $row) {   
            $idFolio = $row['NroFolioGenera'];
			$Prioridad = $row['Prioridad'];

            if( $Prioridad == 1){
                echo "<tr class='info'>";
            }elseif( $Prioridad == 2 ){
		        echo "<tr class='warning'>";
            }elseif( $Prioridad == 3 ){
		        echo "<tr class='danger'>";
            }else{
		        echo "<tr class='default'>";
			}
            echo '<td>'.$row['NroFolioGenera'].'</td>';
            echo '<td>'.$row['FechaCreacion'].'</td>';
            echo '<td>'.$row['DescripcionAsunto'].'</td>';
            echo '<td><span class="btn btn-mini '.$estadoFolio[$row['DescripcionPrioridad']].'">'.$row['DescripcionPrioridad'].'</span></td>';


echo '<td><a class="btn btn-block btn-primary" data-mode="actualizarAlertaFolio" data-id="'.$idFolio.'" href="#">Ver Folio</a></td>';

echo '</tr>';
 } 
?>
        </tbody>
    </table>
    </div>
 
    </section><!-- /.content -->
    </div><!-- /col-10 -->                
  </div><!-- end row -->
</div><!-- end container fluid -->

<!-- Script para inicializar el funcionamiento de la tabla -->
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#tabla_alerta').dataTable({
	  "order": [[ 1, "desc" ]],
	  "fnDrawCallback": function( oSettings ) {
	    
		$(".btn-primary").unbind('click');
		
		$(".btn-primary").on('click',function(){
          mode = $(this).data('mode');
          id = $(this).data('id');
          if(mode == "actualizarAlertaFolio"){
            data={
            idFolio:id,
            tipoProcedimiento:"actualizarAlertaFolio"
            };
            $.ajax({
                async:true,
                type: "POST",
                dataType: "html",
                contentType: "application/x-www-form-urlencoded",
                url:"pages/gestion_folios/datos_folio.php", 
                success:actualizarAlerta,
                timeout:4000,
                error:problemas
            }); 
            return false;
          }
        });
	  }
	}); // example es el id de la tabla
  });
  
  function actualizarAlerta(){

            $("#div_contenido").load('pages/gestion_folios/datos_folio.php',data);
    }
</script>

<!-- Script necesario para que la tabla se ajuste a el tamanio de la pag-->
<script type="text/javascript">
  // For demo to fit into DataTables site builder...
  $('#tabla_alerta')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>

<script type="text/javascript" src="js/gestion_folios/navbar_lateral.js" ></script>
