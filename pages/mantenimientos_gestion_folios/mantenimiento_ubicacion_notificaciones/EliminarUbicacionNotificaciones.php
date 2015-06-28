<?php

    try{
        require_once("../../conexion/config.inc.php");
        $adId_UbicacionNotificaciones = $_POST['Id_UbicacionNotificaciones'];

        $sql = "CALL sp_eliminar_ubicacion_notificaciones(?,@mensaje,@codMensaje)";
        $query = $db->prepare($sql);
        $query ->bindParam(1,$adId_UbicacionNotificaciones,PDO::PARAM_STR);
        $query->execute();

         $output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
	//var_dump($output);
        $mensaje = $output['@mensaje'];
	$codMensaje = $output['@codMensaje'];


    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar la ubicacion de la notificación, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>