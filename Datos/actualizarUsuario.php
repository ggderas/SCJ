<?php
 
	$id = $_POST["idUsuario"];
    $empleado = $_POST["empleado"];
	$nombreUsuarioAnt = $_POST["nombreUsuarioAnt"];
    $nombreUsuario = $_POST["nombreUsuario"];
	$password = $_POST["password"];
	$rol = $_POST["rol"];
    $estado = $_POST["estado"];
	if( $estado == 0 ){
	    $fechaFinalizar=date("Y-m-d");
	}else{
	    $fechaFinalizar=null;
	}
	
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
		
		$stmt = $db->prepare("CALL sp_actualizar_usuario(?,?,?,?,?,?,?,?,@mensaje,@codMensaje)");
		$stmt->bindParam(1, $id, PDO::PARAM_STR); 
        $stmt->bindParam(2, $empleado, PDO::PARAM_STR); 
		$stmt->bindParam(3, $nombreUsuarioAnt, PDO::PARAM_STR); 
		$stmt->bindParam(4, $nombreUsuario, PDO::PARAM_STR); 
		$stmt->bindParam(5, $password, PDO::PARAM_STR); 
		$stmt->bindParam(6, $rol, PDO::PARAM_STR); 
		$stmt->bindParam(7, $fechaFinalizar, PDO::PARAM_STR); 
		$stmt->bindParam(8, $estado, PDO::PARAM_STR);
		
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