<?php

    require($maindir."conexion/config.inc.php");

    $num_folio = $_POST["idFolio"];
    $finalizar = $_POST["finalizar"];
    $prioridad = $_POST["prioridad"];
    $seguimiento = $_POST["seguimiento"];
   	$notas = $_POST["notas"];

    if($num_folio == ""){

        $mensaje="Por favor verifique el numero del folio.";
        $codMensaje =0;

    }elseif($prioridad == -1){

        $mensaje="Por favor verifique la prioridad del folio.";
        $codMensaje =0;

    }elseif($seguimiento == -1 or $notas == ""){
	
	    $mensaje="Por favor introduzca un seguimiento y escriba una nota para dicho seguimiento.";
		$codMensaje =0;
	
	}else{
        
		if($finalizar == "true"){
		    $fecha = date("Y-m-d");
		}elseif($finalizar == "false"){
		    $fecha = NULL;
		}
		
		try{
		$stmt = $db->prepare("CALL sp_actualizar_seguimiento(?,?,?,?,?,@mensaje,@codMensaje)");
        $stmt->bindParam(1, $num_folio, PDO::PARAM_STR);
		$stmt->bindParam(2, $fecha, PDO::PARAM_STR); 
		$stmt->bindParam(3, $prioridad, PDO::PARAM_STR); 
		$stmt->bindParam(4, $seguimiento, PDO::PARAM_STR); 
		$stmt->bindParam(5, $notas, PDO::PARAM_STR); 
		
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

/*
	echo"<HTML>
<meta http-equiv='REFRESH' content='0;url=../../index.php'>
</HTML>";

*/

?>