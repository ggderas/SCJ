<?php

    try{
        require_once("../../conexion/config.inc.php");
        $adId_Estado_Seguimiento = $_POST['Id_Estado_Seguimiento'];

        $sql = "CALL sp_eliminar_estado_seguimiento(?,@mensaje,@codMensaje)";

        $query = $db->prepare($sql);
        $query ->bindParam(1,$adId_Estado_Seguimiento,PDO::PARAM_STR);
        $query->execute();

    	$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
            $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];


    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar el estado del seguimiento, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>