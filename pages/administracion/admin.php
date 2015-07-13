<?php

  $maindir = "../../";

  if(isset($_GET['contenido']))
  {
    $contenido = $_GET['contenido'];
  }
  else
  {
    $contenido = 'administracion';
  }
  
  $estaEnPrincipal = True;
  
  require_once($maindir."funciones/check_session.php");
  
  require_once($maindir."funciones/timeout.php");
  
  require_once($maindir.'pages/navbar.php');

  require_once($maindir."conexion/config.inc.php");
  
  try{
     $query = $db->prepare("show variables like '%event_scheduler%'");
     $query->execute();
     $result2_event = $query->fetch();
  
     $query = null;
  
  }catch(PDOExecption $e){
	 //error;
  }
  
?>

<div class="container"><!--container-->
    <div class="row"><!--row-->
	<div id="mensajes"></div>
	
    <div class="col-md-8 col-sm-4">
      	<div class="panel panel-default">
           <div class="panel-heading"><h4><i class="fa fa-line-chart"></i> Historial de ingreso de los usuarios</h4></div>
		   <div class="panel-body">
		      <div id="chartLog">
			    <?php require_once("grafoEventos.php");?>
			  </div>
		   </div>
        </div>
		
		<div class="panel panel-default">
           <div class="panel-heading">
		      <div class="btn-group" role="group" aria-label="usuarios/logs">
                  <button type="button" class="btn btn-default" id="cargar_usuarios">Usuarios</button>
                  <button type="button" class="btn btn-default" id="cargas_logs">Logs</button>
              </div>
		   </div>
		   <div class="panel-body">
		      <div id="usuariosLog">
			    <?php require_once("Usuarios.php");?>
			  </div>
		   </div>
        </div>
  	</div>
  	<div class="col-md-4 col-sm-6">
        <div class="panel panel-default">
           <div class="panel-heading"><h4><i class="fa fa-tasks"></i> Estatus de los eventos globales</h4></div>
		   <div class="panel-body">
              <p><strong>alertas automáticas de los folios</strong></p>
              <div class="clearfix"></div>
                           <!--Modificado por Enderson Mendez= cambio de lengiaje-->
			  <?php $event = $result2_event['Value'];
			    if($event == "OFF"){
				   echo '<input type="checkbox" name="event" id="event" data-on-text="SI" data-off-text="NO">';   
				}else{
				   echo '<input type="checkbox" name="event" id="event" checked data-on-text="SI" data-off-text="NO">'; 
				}
			  ?>              
              <hr>
              Las alertas automáticas de los folios se crearan conforme se ingresen los folios y se les de seguimiento a estos, en el caso que no se les de seguimiento o no se finalice el seguimiento se crearan alertas cada 3 días después de el ultimo seguimiento.
           </div>
   		</div>
      
	    <div class="panel panel-default">
           <div class="panel-heading"><h4><i class="fa fa-pie-chart"></i> Usuarios del sistema</h4>
		   </div>
		   <div class="panel-body">
              <div class="clearfix"></div>
			    <div id="grafo_usuarios">
				   <?php  require_once("grafoUsuarios.php"); ?>
				</div>	    
           </div>
   		</div>
    </div>
    </div><!--/row-->
</div><!-- /container -->

<script type="text/javascript">
$(document).ready(function() {
    $("[name='event']").bootstrapSwitch();
});	
</script>

<script type="text/javascript" src="js/administracion/admin.js" ></script>