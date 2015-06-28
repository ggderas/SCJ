<?php

    try{
        
        $addIdNotificacion= $_POST['idNotificacion'];
        $addUsuario=$_POST['IdUsuario'];
       


            require_once("../../conexion/config.inc.php");
    
            $sql = "UPDATE usuario_notificado SET IdUbicacionNotificacion ='1' 
                           WHERE Id_Notificacion = :addIdNotificacion and Id_Usuario=:addUsuario";
            $query = $db->prepare($sql);
            $query->bindParam(":addIdNotificacion",$addIdNotificacion);
             $query->bindParam(":addUsuario",$addUsuario);
            $query->execute();

            $mensaje = "Notificacion enviada al basurero!";
            $codMensaje = 1;
        
    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de insertar, por favor intente de nuevo";
        $codMensaje = 0;
    }
    ?>