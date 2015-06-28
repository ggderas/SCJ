<?php

    try{
        
        $addIdNotificacion= $_POST['IdNotificacion'];
        $addUsuario=$_POST['IdUsuario'];
       


            require_once("../../conexion/config.inc.php");
    
            $sql = "UPDATE usuario_notificado SET Estado ='0'
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