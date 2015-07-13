<?php

    $empleado = $_POST["empleado"];
    $nombreUsuario = $_POST["nombreUsuario"];
	$password = $_POST["password"];
	$rol = $_POST["rol"];
    $fechaCreacion=date("Y-m-d");
	
	if($nombreUsuario == "" or $password == ""){
		
		$mensaje="Por favor introduzca un nombre de usuario y password validos";
        $codMensaje =0;
		
    }elseif($empleado == -1){

        $mensaje="Por favor seleccione un empleado valido";
        $codMensaje =0;

    }elseif($rol == -1){
        
        $mensaje="Por favor seleccione un rol valido";
        $codMensaje =0;

    }else{
		
		try{
		$stmt = $db->prepare("CALL sp_insertar_usuario(?,?,?,?,?,@mensaje,@codMensaje)");
        $stmt->bindParam(1, $empleado, PDO::PARAM_STR); 
		$stmt->bindParam(2, $nombreUsuario, PDO::PARAM_STR); 
		$stmt->bindParam(3, $password, PDO::PARAM_STR); 
		$stmt->bindParam(4, $rol, PDO::PARAM_STR); 
		$stmt->bindParam(5, $fechaCreacion, PDO::PARAM_STR); 
		
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
