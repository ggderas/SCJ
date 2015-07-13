<?php

    require_once("../../conexion/config.inc.php");

	if(!isset($_GET["active"])){
	    $mensaje = "Error al tratar de modificar los eventos del sistema";
		$codMensaje = 0;
	}else{
	    $active = $_GET["active"];
		try{
		    if($active === "True" or $active === "true" or $active === true or $active === True){
		        $def = "activos";
		        $stmt = $db->prepare('SET GLOBAL event_scheduler="ON"');
		    }else{
		        $def = "apagados";
		        $stmt = $db->prepare('SET GLOBAL event_scheduler="OFF"');
		    }	
            $stmt->execute();
		
	        $stmt = null;
		    $db = null;
		     
		    $mensaje = "Los eventos del sistema ahora estan ".$def;
		    $codMensaje = 1;
		
	    }catch(PDOExecption $e){
	        $mensaje = "No se ha procesado su peticion, comuniquese con el administrador del sistema";
		    $codMensaje = 0;
	    }
	}
	
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
/*
	echo"<HTML>
<meta http-equiv='REFRESH' content='0;url=../../index.php'>
</HTML>";

*/

?>
