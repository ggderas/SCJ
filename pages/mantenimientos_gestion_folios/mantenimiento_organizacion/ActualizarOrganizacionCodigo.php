<?php

    try{
        $addIdOrganizacion = $_POST['Id_Organizacion'];
        $addNombreOrganizacion = $_POST['NombreOrganizacion'];
        $addUbicacion = $_POST['Ubicacion'];

        if($addNombreOrganizacion == "" or $addNombreOrganizacion == null){
        	$mensaje = "Debe de ingresar un nombre para la organización";
            $codMensaje = 0;
        }elseif($addUbicacion == "" or $addUbicacion == null){
        	$mensaje = "Debe de ingresar una ubicacion para la organización";
            $codMensaje = 0;
        }else{

            require_once("../../conexion/config.inc.php");
    
            $sql = "CALL sp_actualizar_organizacion(?,?,?,@mensaje,@codMensaje)";
            $query1 = $db->prepare($sql);
            $query1->bindParam(1,$addIdOrganizacion,PDO::PARAM_STR);
            $query1->bindParam(2,$addNombreOrganizacion,PDO::PARAM_STR);
            $query1->bindParam(3,$addUbicacion,PDO::PARAM_STR);
       
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