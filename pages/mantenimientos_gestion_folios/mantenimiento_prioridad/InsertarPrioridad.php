 <?php

    try{

        $addId_Prioridad = $_POST['Id_Prioridad'];
	$addDescripcionPrioridad = $_POST['DescripcionPrioridad'];
       
        if($addId_Prioridad == "" or $addId_Prioridad == NULL){
            $mensaje = "Por favor introduzca un ID para la prioridad";
            $codMensaje = 0;
        }
		 elseif($addDescripcionPrioridad == "" or $addDescripcionPrioridad == NULL){
            $mensaje = "Por favor introduzca un nombre para la prioridad";
            $codMensaje = 0;
        }else{

        require_once("../../conexion/config.inc.php");
	
        $sql = "CALL sp_insertar_prioridad(?,?,@mensaje,@codMensaje)";
            $query1 = $db->prepare($sql);
            $query1->bindParam(1,$addId_Prioridad,PDO::PARAM_STR);
            $query1->bindParam(2,$addDescripcionPrioridad,PDO::PARAM_STR);
            $query1->execute();
            
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