<?php
    $rol = $_SESSION['user_rol'];
	if(!isset($userId)){
	    $userId = $_SESSION['user_id'];
	}
	require($maindir."conexion/config.inc.php");
	
	require_once($maindir."pages/gestion_folios/datos/datos_cuenta_alertas.php")
?>

<div class="col-sm-2">
    <!-- Left column -->
      
    <ul class="list-unstyled">
        <li class="nav-header"> <a id="gestion_folios" href="#"><i class="glyphicon glyphicon-home"></i> Inicio Gestión de Folios</a></li>
        <hr>
        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">
            <h5><i class="fa fa-tags"></i> Manejo de folios <i class="glyphicon glyphicon-chevron-down"></i></h5>
            </a>
		<?php
                if($navbar_loc == "contenido"){
				    echo '<ul class="list-unstyled collapse in" id="userMenu">';
				}else{
				    echo '<ul class="list-unstyled collapse" id="userMenu">';
				}

		        if($rol >= 40){
			        echo '<li><a id="folios" href="#"><i class="glyphicon glyphicon-book"></i><span> Folios </span></a></li>';
			    
	                if($cuenta_alertas > 0){
				        echo '<li><a id="alertas"href="#"><i class="glyphicon glyphicon-bell"></i><span> Alertas </span><span class="label label-default pull-right">'.$cuenta_alertas.'</span></a></li>';
				    }else{
				        echo '<li><a id="alertas"href="#"><i class="glyphicon glyphicon-bell"></i><span> Alertas </span></a></li>';
				    }
				}
			        echo '<li><a id="notificaciones" href="#"><i class="glyphicon glyphicon-flag"></i><span> Notificaciones <span></a></li>';
			    
		        if($rol <= 50){
			        echo '<li><a id="misFolios" href="#"><i class="fa fa-bookmark"></i><span> Mis Folios <span></a></li>';
			    }   
		?>
            </ul>
        </li>
		<?php
		    if($rol == 100){
			    echo '<li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2">';
			}else{
			    echo '<li class="nav-header" style="display: none"> <a href="#" data-toggle="collapse" data-target="#menu2">';
			}
		?>
            <h5><i class="glyphicon glyphicon-flash"></i> Mantenimiento <i class="glyphicon glyphicon-chevron-right"></i></h5>
            </a>
			
			<?php 
			    if($navbar_loc == "mantenimiento"){
				    echo '<ul class="list-unstyled collapse in" id="menu2">';
				}else{
				    echo '<ul class="list-unstyled collapse" id="menu2">';
				}
			?>
                <li><a id="mantenimiento_organizacion" href="#">Mantenimiento de Organización</a>
                </li>
                <li><a id="mantenimiento_unidadacademica" href="#">Mantenimiento de unidad académica</a>
                </li>
                <li><a id="mantenimiento_categoria" href="#">Mantenimiento de categoría de folio</a>
                </li>
                <li><a id="mantenimiento_prioridad"href="#">Mantenimiento de prioridad</a>
                </li>
		        <li><a id="mantenimiento_ubicacionfisica"href="#">Mantenimiento de ubicación física</a>
                </li>
                <li><a id="mantenimiento_estado_seguimiento"href="#">Mantenimiento de estado seguimiento</a>
                </li>
                <li><a id="mantenimiento_ubicacion_notificaciones"href="#">Mantenimiento de ubicación notificaciones</a>
                </li>
                <li><a id="mantenimiento_folios"href="#">Mantenimiento de folios</a>
                </li>				
            </ul>
        </li>
    </ul>   
    <hr>
</div><!-- /col-2 -->
<script type='text/javascript'>
        
  $(document).ready(function() {
    $(".alert").addClass("in").fadeOut(4500);
/* swap open/close side menu icons */
      $('[data-toggle=collapse]').click(function(){
      // toggle icon
        $(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
      });  
  });
        
</script>