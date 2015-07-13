<?php


    try{
        require_once("../../conexion/config.inc.php");
        //Eliminar Notificacion
        $IdNotificacion= $_POST['IdNotificacion'];
        

       

        $sql = "DELETE FROM notificaciones_folios WHERE Id_Notificacion = :IdNotificacion ";

        $query= $db->prepare($sql);
        $query ->bindParam(":IdNotificacion",$IdNotificacion);
        $query->execute();

        $mensaje = "Notificacion eliminada correctamente";
        $codMensaje = 1;
    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar la notificacion, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>