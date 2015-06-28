<?php

    try{
        
        $addIdNotificacion= $_POST['idNotificacion'];
       

            require_once("../../conexion/config.inc.php");
    
            $sql = "UPDATE notificaciones_folios SET IdUbicacionNotificacion ='1' 
                           WHERE Id_Notificacion =:addIdNotificacion";
            $query = $db->prepare($sql);
            $query->bindParam(":addIdNotificacion",$addIdNotificacion);
         
            $query->execute();

            $mensaje = "Notificacion enviada al basurero!";
            $codMensaje = 1;
        
    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de insertar, por favor intente de nuevo";
        $codMensaje = 0;
    }
    ?>