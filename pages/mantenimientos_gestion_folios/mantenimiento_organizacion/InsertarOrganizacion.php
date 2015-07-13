 <?php

    try{

        $addNombreOrganizacion = $_POST['Organizacion'];
        $addUbicacion = $_POST['Ubicacion'];

        if($addNombreOrganizacion == "" or $addNombreOrganizacion == NULL){
            $mensaje = "Por favor introduzca un nombre para la organización";
            $codMensaje = 0;
        }elseif($addUbicacion == "" or $addUbicacion == NULL){
            $mensaje = "Por favor introduzca una ubicación para la organización";
            $codMensaje = 0;
        }else{

        require_once("../../conexion/config.inc.php");
	
        $sql = "CALL sp_insertar_organizacion(?,?,@mensaje,@codMensaje)";

        $query = $db->prepare($sql);
        $query ->bindParam(1,$addNombreOrganizacion,PDO::PARAM_STR);
        $query ->bindParam(2,$addUbicacion,PDO::PARAM_STR);
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