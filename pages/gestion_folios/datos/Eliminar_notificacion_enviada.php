<?php


    try{
        //Elimina la notificacion Enviada
        
        $addIdNotificacion= $_POST['IdNotificacion'];
       

            require_once("../../conexion/config.inc.php");
    
            $sql = "UPDATE notificaciones_folios SET  Estado ='0'
                           WHERE Id_Notificacion =:addIdNotificacion";
            $query = $db->prepare($sql);
            $query->bindParam(":addIdNotificacion",$addIdNotificacion);
         
            $query->execute();

            $mensaje = "Notificacion eliminada!";
            $codMensaje = 1;

       
    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar la notificacion, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>