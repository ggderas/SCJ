 <?php

    try{

        $addDescripcionEstadoSeguimiento = $_POST['DescripcionEstadoSeguimiento'];
		
                if($addDescripcionEstadoSeguimiento == "" or $addDescripcionEstadoSeguimiento == NULL){
            $mensaje = "Por favor introduzca una descripción para el estado del seguimiento";
            $codMensaje = 0;
        }else{

        require_once("../../conexion/config.inc.php");
	
        $sql = "CALL sp_insertar_estado_seguimiento(?,@mensaje,@codMensaje)";

        $query = $db->prepare($sql);
        $query ->bindParam(1,$addDescripcionEstadoSeguimiento,PDO::PARAM_STR);
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