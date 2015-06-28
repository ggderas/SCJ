 <?php

    try{

        $addDescripcionUbicacionFisica = $_POST['DescripcionUbicacionFisica'];
        $addCapacidad = $_POST['Capacidad'];
		$addTotalIngresados = $_POST['TotalIngresados'];
		$addHabilitadoParaAlmacenar = $_POST['HabilitadoParaAlmacenar'];

        if($addDescripcionUbicacionFisica == "" or $addDescripcionUbicacionFisica == NULL){
            $mensaje = "Por favor introduzca un nombre para la Ubicación  Física del archivo";
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
	
        $sql = "CALL sp_insertar_ubicacion_archivo_fisica(?,?,?,?,@mensaje,@codMensaje)";

        $query1 = $db->prepare($sql);
        $query1 ->bindParam(1,$addDescripcionUbicacionFisica,PDO::PARAM_STR);
        $query1 ->bindParam(2,$addCapacidad,PDO::PARAM_STR);
	$query1 ->bindParam(3,$addTotalIngresados,PDO::PARAM_STR);
	$query1 ->bindParam(4,$addHabilitadoParaAlmacenar,PDO::PARAM_STR);
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