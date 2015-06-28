	<?php

    require_once("../../conexion/config.inc.php");
    $conexion = mysqli_connect($host,$username, $password, $dbname);

	$num_folioAnt = $_POST["idFolioAnt"];
    $num_folio = $_POST["idFolio"];
    $fechaCreacion = $_POST["fechaCreacion"];
    $fechaEntrada=date("Y-m-d");
    $personaReferente = $_POST["personaReferente"];
    $unidadAcademica = $_POST["unidadAcademica"];
    $organizacion = $_POST["organizacion"];
	$categoria = $_POST["categoria"];
    $descripcion = $_POST["descripcion"];
    $tipoFolio=$_POST["tipoFolio"];
    $ubicacionFisica = $_POST["ubicacionFisica"];
	$prioridadAnt = $_POST["prioridadAnt"];
    $prioridad = $_POST["prioridad"];

    if($num_folio == "" or $fechaCreacion == "" or $fechaEntrada == "" or $personaReferente == "" or $descripcion == "" or $categoria == ""){

        $mensaje="Por favor introduzca todos los campos";
        $codMensaje =0;

    }elseif($tipoFolio == -1 or $ubicacionFisica == -1 or $prioridad == -1 or $categoria == -1){

        $mensaje="Por favor seleccione opciones validas";
        $codMensaje =0;

    }elseif($organizacion == -1 and $unidadAcademica == -1){
        
        $mensaje="Por favor introduzca una organizacion o una unidadAcademica";
        $codMensaje =0;

    }elseif($organizacion != -1 and $unidadAcademica != -1){

        $mensaje="Por favor seleccione solo una organizacion o una unidadAcademica";
        $codMensaje =0;

    }else{
        
        if($organizacion == -1){
		    $organizacion = NULL;
		}elseif($unidadAcademica == -1){
		    $unidadAcademica = NULL;
		}
		
		try{
		$stmt = $db->prepare("CALL sp_actualizar_folio(?,?,?,?,?,?,?,?,?,?,?,?,?,@mensaje,@codMensaje)");
        $stmt->bindParam(1, $num_folioAnt, PDO::PARAM_STR);
		$stmt->bindParam(2, $num_folio, PDO::PARAM_STR);
		$stmt->bindParam(3, $fechaCreacion, PDO::PARAM_STR); 
		$stmt->bindParam(4, $fechaEntrada, PDO::PARAM_STR); 
		$stmt->bindParam(5, $personaReferente, PDO::PARAM_STR); 
		$stmt->bindParam(6, $unidadAcademica, PDO::PARAM_STR); 
		$stmt->bindParam(7, $organizacion, PDO::PARAM_STR); 
		$stmt->bindParam(8, $descripcion, PDO::PARAM_STR); 
		$stmt->bindParam(9, $tipoFolio, PDO::PARAM_STR); 
		$stmt->bindParam(10, $ubicacionFisica, PDO::PARAM_STR); 
		$stmt->bindParam(11, $prioridadAnt, PDO::PARAM_STR);
		$stmt->bindParam(12, $prioridad, PDO::PARAM_STR);
		$stmt->bindParam(13, $categoria, PDO::PARAM_STR);
		
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