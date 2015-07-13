<?php

    try{
        require_once("../../conexion/config.inc.php");
        $adId_categoria = $_POST['Id_categoria'];

       $sql = "CALL sp_eliminar_categorias_folios(?,@mensaje,@codMensaje)";

        $query1 = $db->prepare($sql);
        $query1 ->bindParam(1,$adId_categoria,PDO::PARAM_STR);
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
