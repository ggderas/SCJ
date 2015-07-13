<?php

    try{
        require_once("../../conexion/config.inc.php");
        $adIdOrganizacion = $_POST['Id_Organizacion'];

       $sql = "CALL sp_eliminar_organizacion(?,@mensaje,@codMensaje)";

        $query1 = $db->prepare($sql);
        $query1 ->bindParam(1,$adIdOrganizacion,PDO::PARAM_STR);
        $query1->execute();
        
         	$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
            $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];   


    }catch(PDOExecption $e){
    	$mensaje = "Al tratar de eliminar la organización, por favor intente de nuevo";
        $codMensaje = 0;
    }
	
 ?>