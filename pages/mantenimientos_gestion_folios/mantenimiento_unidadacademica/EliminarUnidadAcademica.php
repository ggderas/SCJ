<?php

    try{
        require_once("../../conexion/config.inc.php");
        $adId_UnidadAcademica = $_POST['Id_UnidadAcademica'];

        $sql = "CALL sp_eliminar_unidad_academica(?,@mensaje,@codMensaje)";

        $query = $db->prepare($sql);
        $query ->bindParam(1,$adId_UnidadAcademica,PDO::PARAM_STR);
        $query->execute();

		$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
            $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];

    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar la Unidad Académica, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>