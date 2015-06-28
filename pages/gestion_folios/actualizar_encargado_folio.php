<?php

    require_once("../../conexion/config.inc.php");
 
    $num_folio = $_POST["idFolio"];
    $encargado = $_POST["encargado"];

    if($num_folio == ""){

        $mensaje="Por favor introduzca todos los campos";
        $codMensaje =0;
		
    }elseif($encargado == -1){
	    
		$mensaje="Por favor seleccione un encargado valido";
        $codMensaje =0;
		
    }else{
		
		try{
		$stmt = $db->prepare("CALL sp_actualizar_asignado_folio(?,?,@mensaje,@codMensaje)");
        $stmt->bindParam(1, $num_folio, PDO::PARAM_STR);
		$stmt->bindParam(2, $encargado, PDO::PARAM_STR);

		
        // call the stored procedure
        $stmt->execute();	
		
		$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
        $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];
		
		}catch(PDOExecption $e){
			$mensaje="No se ha procesado su peticion, comuniquese con el administrador del sistema";
		    $codMensaje =0;
		}

    }
	
?>