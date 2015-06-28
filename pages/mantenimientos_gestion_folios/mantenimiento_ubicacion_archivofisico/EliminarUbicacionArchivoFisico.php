<?php

    try{
        require_once("../../conexion/config.inc.php");
        $adId_UbicacionArchivoFisico = $_POST['Id_UbicacionArchivoFisico'];

        $sql = "CALL sp_eliminar_ubicacion_archivo_fisica(?,@mensaje,@codMensaje)";	
        $query = $db->prepare($sql);
        $query ->bindParam(1,$adId_UbicacionArchivoFisico,PDO::PARAM_STR);
        $query->execute();

       	$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
	//var_dump($output);
        $mensaje = $output['@mensaje'];
	$codMensaje = $output['@codMensaje'];


    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar la Ubicación Archivo Física, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>