<?php

$maindir = "../../../";
include($maindir."conexion/config.inc.php");  

	try{

		$Nid= $_POST['identidad'];
		echo $Nid;
		$stmt = $db->prepare("CALL SP_OBTENER_INFORMACION_ESTUDIANTE(?,@mensajeError)");
		//Introduccion de parametros
		$stmt->bindParam(1, $Nid, PDO::PARAM_STR); 
		$stmt->execute();
		$output = $db->query("select @mensajeError")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
		$mensaje = $output['@mensajeError'];

    }catch(PDOExecption $e){
      $mensaje = 'error al encontrar estudiante';
    }
 ?>