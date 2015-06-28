<?php


    try{
        require_once("../../conexion/config.inc.php");
        //Primero elimino el usuario notificado 
        $IdNotificacion= $_POST['IdNotificacion'];
        $IdUsuario= $_POST['IdUsuario'];

        $sql = "DELETE FROM usuario_notificado WHERE Id_Notificacion = :IdNotificacion and Id_Usuario=:IdUsuario ";

        $query = $db->prepare($sql);
        $query ->bindParam(":IdNotificacion",$IdNotificacion);
        $query ->bindParam(":IdUsuario",$IdUsuario);
        $query->execute();
        $query = null;
       

       
    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar la notificacion, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>