<?php

    require_once($maindir."conexion/config.inc.php");

    $num_folio = $_POST["NroFolio"];
    $fechaCreacion = $_POST["fechaCreacion"];
    $fechaEntrada=date("Y-m-d H:i:s");
    $personaReferente = $_POST["personaReferente"];
    $unidadAcademica = $_POST["unidadAcademica"];
    $organizacion = $_POST["organizacion"];
	$categoria = $_POST["categoria"];
    $descripcion = $_POST["descripcion"];
    $tipoFolio=$_POST["tipoFolio"];
    $ubicacionFisica = $_POST["ubicacionFisica"];
    $prioridad = $_POST["prioridad"];
    $seguimiento = $_POST["seguimiento"];
   	$notas = $_POST["notas"];
	$encargado = $_POST["encargado"];
	
    if($num_folio == "" or $fechaCreacion == "" or $fechaEntrada == "" or $personaReferente == "" or $descripcion == ""){

        $mensaje="Por favor introduzca todos los campos";
        $codMensaje =0;

    }elseif($tipoFolio == -1 or $ubicacionFisica == -1 or $prioridad == -1 or $categoria == -1){

        $mensaje="Por favor introduzca todos los campos";
        $codMensaje =0;

    }elseif($organizacion == -1 and $unidadAcademica == -1){
        
        $mensaje="Por favor introduzca una organizacion o una unidadAcademica";
        $codMensaje =0;

    }elseif($organizacion != -1 and $unidadAcademica != -1){

        $mensaje="Por favor seleccione solo una organizacion o una unidadAcademica";
        $codMensaje =0;

    }elseif($seguimiento == -1 or $notas == ""){
	
	    $mensaje="Por favor introduzca un seguimiento y escriba una nota para dicho seguimiento";
		$codMensaje =0;
	
	}else{
        
		if($organizacion == -1){
		    $organizacion = NULL;
		}elseif($unidadAcademica == -1){
		    $unidadAcademica = NULL;
		}
		
		if($encargado == -1){
		   $encargado = NULL;
		}
		
		try{
		if($tipoProcedimiento == "insertar_con_folio_respuesta"){
	        $folio_respuesta = $_POST["NroFolioRespuesta"];
			$stmt = $db->prepare("CALL sp_insertar_folio_2(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@mensaje,@codMensaje)");
			$stmt->bindParam(15, $folio_respuesta, PDO::PARAM_STR); 
	    }else{
		    $stmt = $db->prepare("CALL sp_insertar_folio(?,?,?,?,?,?,?,?,?,?,?,?,?,?,@mensaje,@codMensaje)");
		}
        $stmt->bindParam(1, $num_folio, PDO::PARAM_STR); 
		$stmt->bindParam(2, $fechaCreacion, PDO::PARAM_STR); 
		$stmt->bindParam(3, $fechaEntrada, PDO::PARAM_STR); 
		$stmt->bindParam(4, $personaReferente, PDO::PARAM_STR); 
		$stmt->bindParam(5, $unidadAcademica, PDO::PARAM_STR); 
		$stmt->bindParam(6, $organizacion, PDO::PARAM_STR);
		$stmt->bindParam(7, $categoria, PDO::PARAM_STR);
		$stmt->bindParam(8, $descripcion, PDO::PARAM_STR);
		$stmt->bindParam(9, $tipoFolio, PDO::PARAM_STR); 
		$stmt->bindParam(10, $ubicacionFisica, PDO::PARAM_STR); 
		$stmt->bindParam(11, $prioridad, PDO::PARAM_STR); 
		$stmt->bindParam(12, $seguimiento, PDO::PARAM_STR); 
		$stmt->bindParam(13, $notas, PDO::PARAM_STR); 
		$stmt->bindParam(14, $encargado, PDO::PARAM_STR); 
		
        $stmt->execute();	
		        // call the stored procedure

		$output = $db->query("select @mensaje, @codMensaje")->fetch(PDO::FETCH_ASSOC);
		//var_dump($output);
        $mensaje = $output['@mensaje'];
		$codMensaje = $output['@codMensaje'];
		
		
		$tipoFolio = 'todos';
		
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
