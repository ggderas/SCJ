 <?php

    try{

        $addDescripcionUbicacionNotificaciones = $_POST['DescripcionUbicacionNotificaciones'];
		
                if($addDescripcionUbicacionNotificaciones == "" or $addDescripcionUbicacionNotificaciones == NULL){
            $mensaje = "Por favor introduzca una descripcion para la descripcion de la notificacion";
            $codMensaje = 0;
        }else{

        require_once("../../conexion/config.inc.php");
	
        $sql = "CALL sp_insertar_ubicacion_notificacion(?,@mensaje,@codMensaje)";

        $query = $db->prepare($sql);
        $query ->bindParam(1,$addDescripcionUbicacionNotificaciones,PDO::PARAM_STR);
        $query->execute();

             $output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
            $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];

        }

    }catch(PDOExecption $e){
        $mensaje = "Al tratar de insertar, por favor intente de nuevo";
        $codMensaje = 0;
    }

?>