<?php

    try{
        $addId_UbicacionNotificaciones = $_POST['Id_UbicacionNotificaciones'];
        $addDescripcionUbicacionNotificaciones = $_POST['DescripcionUbicacionNotificaciones'];        

        if($addDescripcionUbicacionNotificaciones == "" or $addDescripcionUbicacionNotificaciones == null){
        	$mensaje = "Debe de ingresar una descripción para la ubicación de la notificación";
            $codMensaje = 0;
        }else{

            require_once("../../conexion/config.inc.php");
    
            $sql = "CALL sp_actualizar_ubicacion_notificaciones(?,?,@mensaje,@codMensaje)";
			
            $query = $db->prepare($sql);
            $query->bindParam(1,$addId_UbicacionNotificaciones,PDO::PARAM_STR);
            $query->bindParam(2,$addDescripcionUbicacionNotificaciones,PDO::PARAM_STR);        
            $query->execute();

            	$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
            $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];
        }
    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de actualizar, por favor intente de nuevo";
        $codMensaje = 0;
    }
    ?>