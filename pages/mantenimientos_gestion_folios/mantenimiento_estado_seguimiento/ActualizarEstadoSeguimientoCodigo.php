<?php

    try{
        $addId_Estado_Seguimiento = $_POST['Id_Estado_Seguimiento'];
        $addDescripcionEstadoSeguimiento = $_POST['DescripcionEstadoSeguimiento'];        

        if($addDescripcionEstadoSeguimiento == "" or $addDescripcionEstadoSeguimiento == null){
        	$mensaje = "Debe de ingresar una descripción para el estado del seguimiento";
            $codMensaje = 0;
        }else{

            require_once("../../conexion/config.inc.php");
    
            $sql = "CALL sp_actualizar_estado_seguimiento(?,?,@mensaje,@codMensaje)";
			
            $query = $db->prepare($sql);
            $query->bindParam(1,$addId_Estado_Seguimiento,PDO::PARAM_STR);
            $query->bindParam(2,$addDescripcionEstadoSeguimiento,PDO::PARAM_STR);            
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