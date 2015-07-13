<?php

    try{
        $addId_UbicacionArchivoFisico = $_POST['Id_UbicacionArchivoFisico'];	
        $addDescripcionUbicacionFisica = $_POST['DescripcionUbicacionFisica'];
        $addCapacidad = $_POST['Capacidad'];
		$addTotalIngresados = $_POST['TotalIngresados'];
		$addHabilitadoParaAlmacenar = $_POST['HabilitadoParaAlmacenar'];

        if($addDescripcionUbicacionFisica == "" or $addDescripcionUbicacionFisica == NULL){
            $mensaje = "Por favor introduzca una descripción para la Ubicacion  Fisica del archivo";
            $codMensaje = 0;
        }elseif($addCapacidad == "" or $addCapacidad == NULL){
            $mensaje = "Por favor introduzca una Capacidad";
            $codMensaje = 0;
        }elseif($addTotalIngresados == "" or $addTotalIngresados == NULL){
            $mensaje = "Por favor introduzca un Total de ingresados";
            $codMensaje = 0;
        }elseif($addHabilitadoParaAlmacenar == "" or $addHabilitadoParaAlmacenar == NULL){
            $mensaje = "Por favor introduzca un habilitado para almacenar";
            $codMensaje = 0;
        }else{

            require_once("../../conexion/config.inc.php");
    
            $sql = "CALL sp_actualizar_ubicacion_archivo_fisica(?,?,?,?,?,@mensaje,@codMensaje)";
						   
        $query = $db->prepare($sql);
        $query ->bindParam(1,$addId_UbicacionArchivoFisico,PDO::PARAM_STR);
        $query ->bindParam(2,$addDescripcionUbicacionFisica,PDO::PARAM_STR);
        $query ->bindParam(3,$addCapacidad,PDO::PARAM_STR);
	$query ->bindParam(4,$addTotalIngresados,PDO::PARAM_STR);
	$query ->bindParam(5,$addHabilitadoParaAlmacenar,PDO::PARAM_STR);
		
        $query->execute();

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