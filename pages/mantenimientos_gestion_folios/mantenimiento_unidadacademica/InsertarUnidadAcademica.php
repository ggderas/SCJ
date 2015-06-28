 <?php

    try{

        $addNombreUnidadAcademica = $_POST['UnidadAcademica'];
        $addUbicacionUnidadAcademica = $_POST['Ubicacion'];

        if($addNombreUnidadAcademica == "" or $addNombreUnidadAcademica == NULL){
            $mensaje = "Por favor introduzca un nombre para la Unidad Académica";
            $codMensaje = 0;
        }elseif($addUbicacionUnidadAcademica == "" or $addUbicacionUnidadAcademica == NULL){
            $mensaje = "Por favor introduzca una ubicacion para la Unidad Académica";
            $codMensaje = 0;
        }else{

        require_once("../../conexion/config.inc.php");
	
        $sql = "CALL sp_insertar_unidad_academica(?,?,@mensaje,@codMensaje)";

        $query = $db->prepare($sql);
        $query ->bindParam(1,$addNombreUnidadAcademica,PDO::PARAM_STR);
        $query ->bindParam(2,$addUbicacionUnidadAcademica,PDO::PARAM_STR);
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