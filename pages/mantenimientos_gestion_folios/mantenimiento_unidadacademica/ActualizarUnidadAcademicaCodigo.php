<?php

    try{
        $addId_UnidadAcademica = $_POST['Id_UnidadAcademica'];
        $addNombreUnidadAcademica = $_POST['NombreUnidadAcademica'];
        $addUbicacionUnidadAcademica = $_POST['UbicacionUnidadAcademica'];

        if($addNombreUnidadAcademica == "" or $addNombreUnidadAcademica == null){
        	$mensaje = "Debe de ingresar un nombre para la Unidad Académica";
            $codMensaje = 0;
        }elseif($addUbicacionUnidadAcademica == "" or $addUbicacionUnidadAcademica == null){
        	$mensaje = "Debe de ingresar una ubicación para la unidad académica";
            $codMensaje = 0;
        }else{

            require_once("../../conexion/config.inc.php");
    
            $sql = "CALL sp_actualizar_unidad_academica(?,?,?,@mensaje,@codMensaje)";
            $query = $db->prepare($sql);
            $query->bindParam(1,$addId_UnidadAcademica,PDO::PARAM_STR);
            $query->bindParam(2,$addNombreUnidadAcademica,PDO::PARAM_STR);
            $query->bindParam(3,$addUbicacionUnidadAcademica,PDO::PARAM_STR);
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